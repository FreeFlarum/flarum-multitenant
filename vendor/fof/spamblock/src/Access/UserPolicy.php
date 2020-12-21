<?php

/*
 * This file is part of fof/spamblock.
 *
 * Copyright (c) 2018 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace FoF\Spamblock\Access;

use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class UserPolicy extends AbstractPolicy
{
    public function spamblock(User $actor, User $user)
    {
        if ($actor->id === $user->id || $user->can('user.spamblock')) {
            return false;
        }
    }
}
