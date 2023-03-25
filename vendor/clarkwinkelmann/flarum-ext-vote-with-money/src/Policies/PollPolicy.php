<?php

namespace ClarkWinkelmann\VoteWithMoney\Policies;

use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;
use FoF\Polls\Poll;

class PollPolicy extends AbstractPolicy
{
    public function changeVote(User $actor, Poll $poll)
    {
        if ($poll->vote_with_money) {
            return $this->forceDeny();
        }
    }
}
