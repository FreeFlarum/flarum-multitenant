<?php

/*
 * This file is part of nomiscz/flarum-ext-auth-steam.
 *
 * Copyright (c) 2021 NomisCZ.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace NomisCZ\SteamAuth\Api\Controllers;

use Laminas\Diactoros\Response\HtmlResponse;
use Flarum\Forum\Auth\ResponseFactory;
use NomisCZ\SteamAuth\Providers\SteamAuth;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Flarum\User\LoginProvider;

class SteamLinkController implements RequestHandlerInterface
{
    protected $response;
    protected $steam;
    protected $loginProvider;

    public function __construct(ResponseFactory $response, SteamAuth $steam, LoginProvider $loginProvider)
    {
        $this->response = $response;
        $this->steam = $steam;
        $this->loginProvider = $loginProvider;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $actor = $request->getAttribute('actor');
        $actorLoginProviders = $actor->loginProviders()->where('provider', 'steam')->first();

        if ($actorLoginProviders) {
            return $this->makeResponse('already_linked');
        }

        $this->steam->setRequest($request);

        if ($this->steam->validate()) {

            $steamUserInfo = $this->steam->getUserInfo();

            if ($steamUserInfo) {

                if ($this->checkLoginProvider($steamUserInfo->steamid)) {
                    return $this->makeResponse('already_used');
                }

                $created = $actor->loginProviders()->create([
                    'provider' => 'steam',
                    'identifier' => $steamUserInfo->steamid
                ]);

                return $this->makeResponse($created ? 'done' : 'error');
            }
        }

        return $this->steam->redirect();
    }

    private function makeResponse($returnCode = 'done'): HtmlResponse
    {
        $content = "<script>window.close();window.opener.app.steam.linkDone('{$returnCode}');</script>";

        return new HtmlResponse($content);
    }

    private function checkLoginProvider($identifier): bool
    {
        return $this->loginProvider->where([
            ['provider', 'steam'],
            ['identifier', $identifier]
        ])->exists();
    }
}
