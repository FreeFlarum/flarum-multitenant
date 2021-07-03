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

use Fig\Http\Message\StatusCodeInterface;
use Flarum\Forum\Auth\ResponseFactory;
use NomisCZ\SteamAuth\Providers\SteamAuth;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\EmptyResponse;

class SteamUnlinkController implements RequestHandlerInterface
{
    protected $response;
    protected $steam;

    public function __construct(ResponseFactory $response, SteamAuth $steam)
    {
        $this->response = $response;
        $this->steam = $steam;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $actor = $request->getAttribute('actor');
        $actorLoginProviders = $actor->loginProviders()->where('provider', 'steam')->first();

        if (!$actorLoginProviders) {
            return new EmptyResponse(StatusCodeInterface::STATUS_BAD_REQUEST);
        }

        $actorLoginProviders->delete();

        return new EmptyResponse(StatusCodeInterface::STATUS_OK);
    }
}
