<?php

/*
 * This file is part of fof/impersonate.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\Impersonate\Controllers;

use Flarum\Api\Serializer\UserSerializer;
use Flarum\Foundation\ValidationException;
use Flarum\Http\Rememberer;
use Flarum\Http\SessionAccessToken;
use Flarum\Http\SessionAuthenticator;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;
use FoF\Impersonate\Events\Impersonated;
use Illuminate\Contracts\Session\Session;
use Illuminate\Events\Dispatcher;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class LoginController implements RequestHandlerInterface
{
    /**
     * @var SessionAuthenticator
     */
    protected $authenticator;

    /**
     * @var Rememberer
     */
    protected $rememberer;

    /**
     * @var Dispatcher
     */
    protected $bus;

    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    public $serializer = UserSerializer::class;

    public function __construct(SessionAuthenticator $authenticator, Rememberer $rememberer, Dispatcher $bus, SettingsRepositoryInterface $settings, TranslatorInterface $translator)
    {
        $this->authenticator = $authenticator;
        $this->rememberer = $rememberer;
        $this->bus = $bus;
        $this->settings = $settings;
        $this->translator = $translator;
    }

    /**
     * Handle the request and return a response.
     *
     * @param ServerRequestInterface $request
     *
     * @throws \Flarum\User\Exception\PermissionDeniedException
     *
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /**
         * @var User $actor
         */
        $actor = $request->getAttribute('actor');

        $requestBody = $request->getParsedBody();
        $requestData = $requestBody['data']['attributes'];

        $id = $requestData['userId'];
        $reason = $requestData['reason'];

        if ((bool) $this->settings->get('fof-impersonate.require_reason') && $reason === '') {
            throw new ValidationException([
                'error' => $this->translator->trans('fof-impersonate.forum.modal.placeholder_required'),
            ]);
        }

        /**
         * @var User $user
         */
        $user = User::findOrFail($id);

        $actor->assertCan('fofCanImpersonate', $user);

        /**
         * @var Session $session
         */
        $session = $request->getAttribute('session');
        $this->authenticator->logIn($session, SessionAccessToken::generate($user->id));

        $this->bus->dispatch(new Impersonated($actor, $user, $reason));

        return $this->rememberer->forget(new JsonResponse(
            [
                'data' => [
                    'type'       => 'impersonate',
                    'attributes' => [
                        'success' => true,
                    ],
                ],
            ]
        ));
    }
}
