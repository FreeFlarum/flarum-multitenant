<?php

/*
 * This file is part of nomiscz/flarum-ext-auth-steam.
 *
 * Copyright (c) 2019 NomisCZ.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace NomisCZ\SteamAuth\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface;
use NomisCZ\SteamAuth\Flarum\Forum\Auth\NResponseFactory;
use NomisCZ\SteamAuth\Providers\SteamAuth;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\EmptyResponse;

class SteamUnlinkController implements RequestHandlerInterface
{
    protected $response;
    protected $steam;

    public function __construct(NResponseFactory $response, SteamAuth $steam)
    {
        $this->response = $response;
        $this->steam = $steam;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $actor = $request->getAttribute('actor');
        $actorLoginProviders = $actor->loginProviders()->where('provider', 'steam')->first();

        if ($actorLoginProviders) {
            $actorLoginProviders->delete();
            return new EmptyResponse(StatusCodeInterface::STATUS_OK);
        }

        return new EmptyResponse(StatusCodeInterface::STATUS_BAD_REQUEST);
    }
}