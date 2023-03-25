<?php

namespace ClarkWinkelmann\VoteWithMoney\Providers;

use Flarum\Foundation\AbstractServiceProvider;
use Flarum\Foundation\ValidationException;
use Flarum\Locale\Translator;
use Flarum\Settings\SettingsRepositoryInterface;
use FoF\Polls\Commands\VotePoll;
use FoF\Polls\Events\PollWasVoted;
use FoF\Polls\Poll;
use FoF\Polls\PollVote;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Arr;

class PipeThroughPollVote extends AbstractServiceProvider
{
    public function register()
    {
        $this->container->resolving(Dispatcher::class, function (Dispatcher $bus) {
            $bus->pipeThrough([
                function ($command, $next) {
                    // Ignore other command on the bus
                    if (!($command instanceof VotePoll)) {
                        return $next($command);
                    }

                    /**
                     * @var $poll Poll
                     */
                    $poll = Poll::findOrFail($command->pollId);

                    // If it's not a money-based poll, keep original logic
                    if (!$poll->vote_with_money) {
                        return $next($command);
                    }

                    $actor = $command->actor;

                    $actor->assertCan('vote', $poll);

                    $data = $command->data;
                    $optionId = Arr::get($data, 'optionId');
                    $amount = (int)Arr::get($data, 'amountPledged');

                    if (!$optionId) {
                        throw new ValidationException([
                            'optionId' => resolve(Translator::class)->trans('clarkwinkelmann-vote-with-money.api.error.cannotCancel'),
                        ]);
                    }

                    $settings = resolve(SettingsRepositoryInterface::class);

                    $amountRules = [
                        'numeric',
                        'min:' . ($poll->money_vote_min ?? max(0, (int)$settings->get('vote-with-money.amountMin'))),
                    ];

                    $amountMax = $poll->money_vote_max ?? ((int)$settings->get('vote-with-money.amountMax') ?: null);

                    if ($amountMax > 0) {
                        $amountRules[] = 'max:' . $amountMax;
                    }

                    resolve(Factory::class)->make([
                        'amount' => $amount,
                    ], [
                        'amount' => $amountRules,
                    ])->validate();

                    if ($amount > $actor->money) {
                        throw new ValidationException([
                            'amountPledged' => resolve(Translator::class)->trans('clarkwinkelmann-vote-with-money.api.error.notEnoughFunds'),
                        ]);
                    }

                    /**
                     * @var $vote PollVote|null
                     */
                    $vote = $poll->votes()->where('user_id', $actor->id)->first();

                    if ($vote) {
                        throw new ValidationException([
                            'optionId' => resolve(Translator::class)->trans('clarkwinkelmann-vote-with-money.api.error.cannotChange'),
                        ]);
                    }

                    /**
                     * @var PollVote $vote
                     */
                    $vote = resolve(ConnectionInterface::class)->transaction(function () use ($actor, $poll, $optionId, $amount) {
                        $actor->money -= $amount;
                        $actor->save();

                        $vote = new PollVote();
                        $vote->user_id = $actor->id;
                        $vote->option_id = $optionId;
                        $vote->money_pledged = $amount;

                        // Can't re-use create() like in Polls extension because our own attribute isn't fillable
                        $poll->votes()->save($vote);

                        return $vote;
                    });

                    // This call replaces PollOption::refreshVoteCount()
                    $vote->option->vote_count = $vote->option->votes()->sum('money_pledged');
                    $vote->option->save();

                    resolve(\Illuminate\Contracts\Events\Dispatcher::class)->dispatch(new PollWasVoted($actor, $poll, $vote, true));

                    $poll->vote_count = $poll->votes()->sum('money_pledged');
                    $poll->save();

                    return $poll;
                },
            ]);
        });
    }
}

