<?php

/*
 * This file is part of fof/ignore-users.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\IgnoreUsers\Event;

use Flarum\User\User;

class Ignoring
{
    /**
     * The user who is performing the action.
     *
     * @var User
     */
    public $actor;

    /**
     * The user who is getting ignored.
     *
     * @var array
     */
    public $user;

    /**
     * @param User $actor The user who is performing the action.
     * @param User $user  The user who is getting ignored.
     */
    public function __construct(User $actor, User $user)
    {
        $this->actor = $actor;
        $this->user = $user;
    }
}
