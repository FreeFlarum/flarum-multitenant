<?php

namespace ClarkWinkelmann\Status\Policies;

use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class UserPolicy extends AbstractPolicy
{
    public function clarkwinkelmannStatusEdit(User $actor, User $user)
    {
        if ($actor->hasPermission('clarkwinkelmann-status.mod')) {
            return true;
        }

        return $actor->hasPermission('clarkwinkelmann-status.set') && $actor->id === $user->id;
    }
}
