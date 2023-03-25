<?php

/*
 * This file is part of fof/ban-ips.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\BanIPs\Commands;

use Flarum\User\User;

class UnbanUser
{
    /**
     * @var int
     */
    public $userId;

    /**
     * @var User
     */
    public $actor;

    /**
     * @param User $actor
     * @param int  $userId
     */
    public function __construct(User $actor, int $userId)
    {
        $this->actor = $actor;
        $this->userId = $userId;
    }
}
