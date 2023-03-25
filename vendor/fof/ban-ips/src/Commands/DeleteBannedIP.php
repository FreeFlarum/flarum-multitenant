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

class DeleteBannedIP
{
    /**
     * @var User
     */
    public $actor;

    /**
     * @var int
     */
    public $bannedId;

    /**
     * @param int  $bannedId
     * @param User $actor
     */
    public function __construct(User $actor, int $bannedId)
    {
        $this->actor = $actor;
        $this->bannedId = $bannedId;
    }
}
