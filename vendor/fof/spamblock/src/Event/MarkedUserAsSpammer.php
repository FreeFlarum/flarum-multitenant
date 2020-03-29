<?php

/*
 * This file is part of fof/spamblock.
 *
 * Copyright (c) 2018 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace FoF\Spamblock\Event;

use Flarum\User\User;

class MarkedUserAsSpammer
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var User
     */
    public $actor;

    public function __construct(User $user, User $actor)
    {
        $this->user = $user;
        $this->actor = $actor;
    }
}
