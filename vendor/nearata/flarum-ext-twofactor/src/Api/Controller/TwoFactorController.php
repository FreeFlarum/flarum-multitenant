<?php

namespace Nearata\TwoFactor\Api\Controller;

use Flarum\Foundation\Config;
use Flarum\Http\RequestUtil;
use Illuminate\Support\Str;
use Laminas\Diactoros\Response\EmptyResponse;
use Laminas\Diactoros\Response\JsonResponse;
use OTPHP\TOTP;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TwoFactorController implements RequestHandlerInterface
{
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $actor = RequestUtil::getActor($request);

        if ($actor->isGuest()) {
            return new EmptyResponse(403);
        }

        $active = (bool) $actor->twofa_active;
        $payload = [
            'enabled' => $active,
            'qrCode' => '',
            'secret' => ''
        ];

        if (!$active) {
            $otp = TOTP::create();
            $payload['secret'] = $otp->getSecret();

            $otp->setLabel($actor->username);
            $otp->setIssuer($this->config->url()->getHost());
            $payload['qrCode'] = $otp->getProvisioningUri();
        }

        return new JsonResponse($payload);
    }
}
