<?php

/*
 * This file is part of fof/ban-ips.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\BanIPs\Events;

use Flarum\User\User;
use FoF\BanIPs\BannedIP;

class IPWasBanned
{
    /**
     * @var User
     */
    public $actor;

    /**
     * @var BannedIP
     */
    public $bannedIP;

    /**
     * @param User     $actor
     * @param BannedIP $bannedIP
     */
    public function __construct(User $actor, BannedIP $bannedIP)
    {
        $this->actor = $actor;
        $this->bannedIP = $bannedIP;
    }
}
