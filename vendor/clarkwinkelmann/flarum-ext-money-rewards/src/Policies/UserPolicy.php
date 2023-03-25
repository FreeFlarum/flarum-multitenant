<?php

namespace ClarkWinkelmann\MoneyRewards\Policies;

use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class UserPolicy extends AbstractPolicy
{
    public function seeMoneyRewardHistory(User $actor, User $user)
    {
        return $actor->id === $user->id || $actor->hasPermission('money-rewards.seeMoneyRewardHistory');
    }
}
