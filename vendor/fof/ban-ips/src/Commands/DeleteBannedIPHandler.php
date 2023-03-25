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
use FoF\BanIPs\Repositories\BannedIPRepository;

class DeleteBannedIPHandler
{
    /**
     * @var BannedIPRepository
     */
    private $bannedIPs;

    public function __construct(BannedIPRepository $bannedIPs)
    {
        $this->bannedIPs = $bannedIPs;
    }

    /**
     * @param DeleteBannedIP $command
     *
     * @return BanIP
     */
    public function handle(DeleteBannedIP $command)
    {
        /**
         * @var User
         */
        $actor = $command->actor;

        $actor->assertCan('banIP');

        $banIP = $this->bannedIPs->findOrFail($command->bannedId);

        $banIP->delete();
    }
}
