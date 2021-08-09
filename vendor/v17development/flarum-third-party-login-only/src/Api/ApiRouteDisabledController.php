<?php

namespace V17Development\FlarumThirdPartyLoginOnly\Api;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;

class ApiRouteDisabledController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse([
            "status" => 403,
            "error" => "Route disabled"
        ], 403);
    }
}
