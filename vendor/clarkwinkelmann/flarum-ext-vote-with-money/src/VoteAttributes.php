<?php

namespace ClarkWinkelmann\VoteWithMoney;

use FoF\Polls\Api\Serializers\PollVoteSerializer;
use FoF\Polls\PollVote;

class VoteAttributes
{
    public function __invoke(PollVoteSerializer $serializer, PollVote $vote): array
    {
        if (!$vote->money_pledged) {
            return [];
        }

        return [
            'moneyPledged' => (int)$vote->money_pledged,
        ];
    }
}
