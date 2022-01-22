<?php

namespace Nearata\TwoFactor\Api\Controller;

use Flarum\Http\RequestUtil;
use Flarum\Settings\SettingsRepositoryInterface;
use Laminas\Diactoros\Response\EmptyResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TwoFactorBackupsController implements RequestHandlerInterface
{
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $actor = RequestUtil::getActor($request);

        if ($actor->isGuest()) {
            return new EmptyResponse(403);
        }

        $canGenerate = $this->settings->get('nearata-twofactor.admin.generate_backups', false);

        if (!$canGenerate) {
            return new EmptyResponse(401);
        }

        if (!$actor->twofa_active) {
            return new EmptyResponse(401);
        }

        $codes = json_decode($actor->twofa_codes);

        if ($codes && count($codes) > 0) {
            return new EmptyResponse(401);
        }

        $newBackups = [];

        for($i = 0; $i < 16; $i++) {
            $bytes = random_bytes(4);
            $hex = bin2hex($bytes);
            array_push($newBackups, $hex);
        }

        $actor->twofa_codes = json_encode($newBackups);
        $actor->save();

        return new JsonResponse(['codes' => $newBackups]);
    }
}
