<?php

/*
 * This file is part of fof/impersonate.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\Impersonate\Access;

use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class UserPolicy extends AbstractPolicy
{
    public function fofCanImpersonate(User $actor, User $user)
    {
        if (
            $actor->hasPermission('fof-impersonate.login') &&
            $actor->id !== $user->id &&
            (!$user->isAdmin() || $actor->isAdmin())
        ) {
            return $this->allow();
        }

        return $this->deny();
    }
}
