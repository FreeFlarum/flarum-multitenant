<?php

/*
 * This file is part of fof/ignore-users.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\IgnoreUsers\Access;

use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class UserPolicy extends AbstractPolicy
{
    /**
     * @param User $actor
     * @param User $user
     *
     * @return bool|null
     */
    public function ignore(User $actor, User $user)
    {
        if ($user->hasPermission('notBeIgnored') || $user->id === $actor->id) {
            return $this->deny();
        }

        return $this->allow();
    }
}
