<?php

namespace Nearata\TwoFactor\Api\Controller;

use Illuminate\Support\Arr;
use Laminas\Diactoros\Response\EmptyResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Nearata\TwoFactor\Helpers;
use OTPHP\TOTP;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TwoFactorUpdateController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $actor = $request->getAttribute('actor');

        if ($actor->isGuest()) {
            return new EmptyResponse(403);
        }

        $data = $request->getParsedBody();
        $code = Arr::get($data, 'code');
        $password = Arr::get($data, 'password');
        $secret = Arr::get($data, 'secret');

        if (is_null($code) || is_null($password) || is_null($secret)) {
            return new EmptyResponse(401);
        }

        if (!$actor->checkPassword($password)) {
            return new EmptyResponse(401);
        }

        if ($actor->twofa_active) {
            $secret = $actor->twofa_secret;
        }

        $otp = TOTP::create($secret);

        if (!$otp->verify($code) && ($actor->twofa_active && !Helpers::isBackupCode($actor, $code))) {
            return new EmptyResponse(401);
        }

        if ($actor->twofa_active) {
            $actor->twofa_active = false;
            $actor->twofa_secret = '';
            $actor->twofa_codes = '';
        } else {
            $actor->twofa_active = true;
            $actor->twofa_secret = $secret;
        }

        $actor->save();

        return new JsonResponse(['enabled' => $actor->twofa_active]);
    }
}
