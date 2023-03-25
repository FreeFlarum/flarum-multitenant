<?php

/*
 * This file is part of fof/ban-ips.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\BanIPs\Api\Controllers;

use Flarum\Api\Controller\AbstractListController;
use Flarum\Http\RequestUtil;
use Flarum\User\User;
use FoF\BanIPs\Api\Serializers\BannedIPSerializer;
use FoF\BanIPs\Repositories\BannedIPRepository;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ListUserBannedIPsController extends AbstractListController
{
    /**
     * {@inheritdoc}
     */
    public $include = ['user'];

    /**
     * {@inheritdoc}
     */
    public $optionalInclude = ['creator'];

    /**
     * {@inheritdoc}
     */
    public $serializer = BannedIPSerializer::class;

    /**
     * @var BannedIPRepository
     */
    private $bannedIPs;

    public function __construct(BannedIPRepository $bannedIPs)
    {
        $this->bannedIPs = $bannedIPs;
    }

    /**
     * {@inheritdoc}
     */
    protected function data(ServerRequestInterface $request, Document $document)
    {
        /**
         * @var User
         */
        $actor = RequestUtil::getActor($request);

        $actor->assertCan('fof.banips.viewBannedIPList');

        $id = Arr::get($request->getQueryParams(), 'id');
        $user = User::where('id', $id)->orWhere('username', $id)->firstOrFail();

        return $this->bannedIPs->getUserBannedIPs($user)->get();
    }
}
