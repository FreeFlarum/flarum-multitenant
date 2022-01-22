<?php

namespace ClarkWinkelmann\ShadowBan\Policy;

use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class UserPolicy extends AbstractPolicy
{
    /**
     * @param User $actor
     * @param User|string $user User model or ::class
     * @return bool
     */
    public function shadowBan(User $actor, $user = ''): bool
    {
        return $actor->hasPermission('clarkwinkelmann-shadow-ban.ban');
    }
}
