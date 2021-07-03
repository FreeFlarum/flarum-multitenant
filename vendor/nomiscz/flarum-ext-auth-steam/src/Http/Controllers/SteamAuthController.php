<?php

/*
 * This file is part of nomiscz/flarum-ext-auth-steam.
 *
 * Copyright (c) 2021 NomisCZ.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace NomisCZ\SteamAuth\Http\Controllers;

use NomisCZ\SteamAuth\Providers\SteamAuth;
use Flarum\Forum\Auth\ResponseFactory;
use Exception;
use Flarum\Forum\Auth\Registration;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;

class SteamAuthController implements RequestHandlerInterface
{
    protected $response;
    protected $steam;

    public function __construct(ResponseFactory $response, SteamAuth $steam)
    {
        $this->response = $response;
        $this->steam = $steam;
    }

    /**
     * @param Request $request
     * @return ResponseInterface
     * @throws Exception
     */
    public function handle(Request $request): ResponseInterface
    {
        $this->steam->setRequest($request);

        if ($this->steam->validate()) {

            $steamUserInfo = $this->steam->getUserInfo();

            if ($steamUserInfo) {

                $suggestions = [
                    'id' => $steamUserInfo->steamid,
                    'personaName' => $steamUserInfo->personaname,
                    'avatarUrl' => $steamUserInfo->avatarfull,
                ];

                return $this->response->make(
                    'steam',
                    $suggestions['id'],
                    function (Registration $registration) use ($suggestions) {
                        $registration
                            ->provideAvatar($suggestions['avatarUrl'])
                            ->suggestUsername($suggestions['personaName'])
                            ->setPayload($suggestions);
                    }
                );
            }
        }

        return $this->steam->redirect();
    }
}
