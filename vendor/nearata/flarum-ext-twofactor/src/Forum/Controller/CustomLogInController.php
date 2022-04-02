<?php

namespace Nearata\TwoFactor\Forum\Controller;

use Flarum\Api\Controller\CreateTokenController;
use Flarum\Forum\Controller\LogInController;
use Flarum\Http\AccessToken;
use Flarum\Http\RememberAccessToken;
use Flarum\User\Event\LoggedIn;
use Illuminate\Support\Arr;
use Laminas\Diactoros\Response\EmptyResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Nearata\TwoFactor\Helpers;
use OTPHP\TOTP;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CustomLogInController extends LogInController
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();
        $params = Arr::only($body, ['identification', 'password', 'remember']);

        $response = $this->apiClient->withParentRequest($request)->withBody($params)->post('/token');

        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getBody());

            $user = $this->users->findOrFail($data->userId);

            if ($user->twofa_active) {
                $code = Arr::get($body, 'twofa');

                if (is_null($code)) {
                    return new JsonResponse(['has2FA' => true], 401);
                }

                $otp = TOTP::create($user->twofa_secret);
                if (!$otp->verify($code) && !Helpers::isBackupCode($user, $code)) {
                    return new EmptyResponse(401);
                }
            }

            $token = AccessToken::findValid($data->token);

            $session = $request->getAttribute('session');
            $this->authenticator->logIn($session, $token);

            $this->events->dispatch(new LoggedIn($this->users->findOrFail($data->userId), $token));

            if ($token instanceof RememberAccessToken) {
                $response = $this->rememberer->remember($response, $token);
            }
        }

        return $response;
    }
}
