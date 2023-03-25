<?php

namespace ClarkWinkelmann\VoteWithMoney\Listeners;

use Flarum\Foundation\ValidationException;
use Flarum\Locale\Translator;
use FoF\Polls\Events\SavingPollAttributes;
use Illuminate\Support\Arr;

class SavePoll
{
    public function handle(SavingPollAttributes $event)
    {
        if (Arr::exists($event->attributes, 'voteWithMoney')) {
            if (Arr::get($event->attributes, 'voteWithMoney')) {
                $event->poll->vote_with_money = true;

                $min = Arr::get($event->attributes, 'moneyVoteMin');
                $max = Arr::get($event->attributes, 'moneyVoteMax');

                $event->poll->money_vote_min = is_numeric($min) && $min >= 0 ? $min : null;
                $event->poll->money_vote_max = is_numeric($max) && $max > 0 ? $max : null;
            } else {
                $event->poll->vote_with_money = false;
                $event->poll->money_vote_min = null;
                $event->poll->money_vote_max = null;
            }
        }

        if ($event->poll->isDirty('vote_with_money') && $event->poll->exists && $event->poll->votes()->count() > 0) {
            throw new ValidationException([
                'voteWithMoney' => resolve(Translator::class)->trans('clarkwinkelmann-vote-with-money.api.error.cannotChangePollType'),
            ]);
        }
    }
}
