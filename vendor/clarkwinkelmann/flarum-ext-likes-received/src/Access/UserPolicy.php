<?php

namespace ClarkWinkelmann\LikesReceived\Access;

use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class UserPolicy extends AbstractPolicy
{
    public function viewLikesReceived(User $actor, User $user): bool
    {
        return $actor->id === $user->id || $actor->hasPermission('clarkwinkelmann-likes-received.view');
    }
}
