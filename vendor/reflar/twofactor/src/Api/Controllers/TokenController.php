<?php

/*
 * This file is based on Flarum's Api/Controller/TokenController.php
 *
 * (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Reflar\twofactor\Api\Controllers;

use Flarum\Http\AccessToken;
use Flarum\User\Exception\PermissionDeniedException;
use Flarum\User\UserRepository;
use Illuminate\Contracts\Bus\Dispatcher as BusDispatcher;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Reflar\twofactor\TwoFactor;
use Zend\Diactoros\Response\JsonResponse;

class TokenController implements RequestHandlerInterface
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @var BusDispatcher
     */
    protected $bus;

    /**
     * @var EventDispatcher
     */
    protected $events;

    /**
     * @var TwoFactor
     */
    protected $twoFactor;

    /**
     * @param UserRepository  $users
     * @param BusDispatcher   $bus
     * @param EventDispatcher $events
     * @param TwoFactor       $twoFactor
     */
    public function __construct(
        UserRepository $users,
        BusDispatcher $bus,
        EventDispatcher $events,
        TwoFactor $twoFactor
    ) {
        $this->users = $users;
        $this->bus = $bus;
        $this->events = $events;
        $this->twoFactor = $twoFactor;
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @throws PermissionDeniedException
     * @throws \Twilio\Exceptions\ConfigurationException
     *
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        $password = array_get($body, 'password');
        $identification = array_get($body, 'identification');
        $lifetime = array_get($body, 'lifetime', 3600);

        $user = $this->users->findByIdentification($identification);

        if (!$user || !$user->checkPassword($password)) {
            throw new PermissionDeniedException();
        }

        $twofactor = array_get($body, 'twofactor');
        $pageId = array_get($body, 'pageId');

        if (!$twofactor) {
            $twofactor = '0';
        }

        if (2 === $user->twofa_enabled) {
            if ($this->twoFactor->verifyTOTPCode($user, $twofactor)) {
                return $this->generateAccessCode($user, $lifetime);
            } else {
                return new JsonResponse(['userId' => 'IncorrectCode']);
            }
        } elseif (4 === $user->twofa_enabled) {
            if ($this->twoFactor->verifyPhoneCode($user, $twofactor)) {
                return $this->generateAccessCode($user, $lifetime);
            } else {
                if ($user->pageId !== $pageId) {
                    $user->pageId = $pageId;
                    $user->save();
                    $this->twoFactor->sendText($user);
                }

                return new JsonResponse(['userId' => 'IncorrectCode']);
            }
        } elseif (6 === $user->twofa_enabled) {
            if ($user->authy_status === 'approved') {
                $user->authy_status = 'unverified';
                $user->save();

                return $this->generateAccessCode($user, $lifetime);
            } elseif ($this->twoFactor->verifyAuthyCode($user, $twofactor)) {
                return $this->generateAccessCode($user, $lifetime);
            } elseif ($user->pageId !== $pageId) {
                $user->pageId = $pageId;
                $user->save();
                $this->twoFactor->sendOneTouch($user);
            }

            return new JsonResponse(['userId' => 'IncorrectOneCode']);
        } else {
            return $this->generateAccessCode($user, $lifetime);
        }
    }

    /**
     * @param $user
     * @param $lifetime
     *
     * @return JsonResponse
     */
    protected function generateAccessCode($user, $lifetime)
    {
        $token = AccessToken::generate($user->id, $lifetime);
        $token->save();

        return new JsonResponse([
            'token'  => $token->token,
            'userId' => $user->id,
        ]);
    }
}
