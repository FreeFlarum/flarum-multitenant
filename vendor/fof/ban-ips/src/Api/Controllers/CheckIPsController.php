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
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Foundation\ValidationException;
use Flarum\Http\Exception\RouteNotFoundException;
use Flarum\Http\RequestUtil;
use Flarum\User\User;
use FoF\BanIPs\Repositories\BannedIPRepository;
use FoF\BanIPs\Validators\BannedIPValidator;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class CheckIPsController extends AbstractListController
{
    /**
     * {@inheritdoc}
     */
    public $include = ['banned_ips'];

    /**
     * @var BannedIPRepository
     */
    private $bannedIPs;

    /**
     * @var BannedIPValidator
     */
    private $validator;

    /**
     * @param BannedIPRepository $bannedIPs
     * @param BannedIPValidator  $validator
     */
    public function __construct(BannedIPRepository $bannedIPs, BannedIPValidator $validator)
    {
        $this->bannedIPs = $bannedIPs;
        $this->validator = $validator;
    }

    /**
     * @var string
     */
    public $serializer = UserSerializer::class;

    /**
     * Get the data to be serialized and assigned to the response document.
     *
     * @param ServerRequestInterface $request
     * @param Document               $document
     *
     * @return mixed
     */
    protected function data(ServerRequestInterface $request, Document $document)
    {
        /**
         * @var User
         */
        $actor = RequestUtil::getActor($request);
        $params = $request->getQueryParams();

        $actor->assertCan('banIP');

        $userId = Arr::get($params, 'user');
        $ip = Arr::get($params, 'ip');
        $user = $userId != null ? User::where('id', $userId)->orWhere('username', $userId)->first() : null;

        $actor->assertCan('banIP', $user);

        if (!isset($ip) && !isset($user)) {
            throw new RouteNotFoundException();
        }

        $ip = Arr::get($params, 'ip');
        $validate = !Arr::has($params, 'skipValidation');

        if ($ip && $validate) {
            $this->validator->assertValid(['address' => $ip]);
        }

        $ips = Arr::wrap($ip ?? $this->bannedIPs->getUserIPs($user)->toArray());

        if (empty($ips)) {
            throw new ValidationException([
                resolve('translator')->trans('fof-ban-ips.error.no_ips_found_message'),
            ]);
        }

        $users = $user != null
            ? $this->bannedIPs->findOtherUsers($user, $ips)
            : $this->bannedIPs->findUsers($ips);

        return $users;
    }
}
