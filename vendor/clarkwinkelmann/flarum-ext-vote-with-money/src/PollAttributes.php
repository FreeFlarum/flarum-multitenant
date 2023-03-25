<?php

namespace ClarkWinkelmann\VoteWithMoney;

use Flarum\Settings\SettingsRepositoryInterface;
use FoF\Polls\Api\Serializers\PollSerializer;
use FoF\Polls\Poll;

class PollAttributes
{
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(PollSerializer $serializer, Poll $poll): array
    {
        if ($poll->vote_with_money) {
            return [
                'voteWithMoney' => true,
                'moneyVoteMin' => $poll->money_vote_min ?? max(0, (int)$this->settings->get('vote-with-money.amountMin')),
                'moneyVoteMax' => $poll->money_vote_max ?? ((int)$this->settings->get('vote-with-money.amountMax') ?: null),
            ];
        }

        return [
            'voteWithMoney' => false,
        ];
    }
}
