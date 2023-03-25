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

class BanUser
{
    /**
     * @var User
     */
    public $actor;

    /**
     * @var int
     */
    public $userId;

    /**
     * @var array
     */
    public $data;

    /**
     * @param User  $actor
     * @param int   $userId
     * @param array $data
     */
    public function __construct(User $actor, int $userId, array $data)
    {
        $this->actor = $actor;
        $this->userId = $userId;
        $this->data = $data;
    }
}
