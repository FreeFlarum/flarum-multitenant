<?php

/*
 * This file is part of fof/ban-ips.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\BanIPs\Listeners;

use Flarum\Api\Controller\AbstractListController;
use Flarum\Http\RequestUtil;
use FoF\BanIPs\Repositories\BannedIPRepository;
use Psr\Http\Message\ServerRequestInterface;

class BannedIPsData
{
    /**
     * @var BannedIPRepository
     */
    private $bannedIPs;

    public function __construct(BannedIPRepository $bannedIPs)
    {
        $this->bannedIPs = $bannedIPs;
    }

    public function __invoke(AbstractListController $controller, &$data, ServerRequestInterface $request)
    {
        $canView = RequestUtil::getActor($request)->can('fof.ban-ips.viewBannedIPList');

        foreach ($data as $d) {
            $d['banned_ips'] = $canView ? $this->bannedIPs->getUserBannedIPs($d)->get() : [];
        }

        return $data;
    }
}
