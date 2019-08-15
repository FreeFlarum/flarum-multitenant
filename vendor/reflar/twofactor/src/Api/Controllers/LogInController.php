<?php

/*
 * This file is based on Flarum's Forum/Controller/LogInController.php
 *
 * (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Reflar\twofactor\Api\Controllers;

use Flarum\Api\Client;
use Flarum\Http\AccessToken;
use Flarum\Http\Rememberer;
use Flarum\Http\SessionAuthenticator;
use Flarum\User\Event\LoggedIn;
use Flarum\User\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;

class LogInController implements RequestHandlerInterface
{
    /**
     * @var \Flarum\User\UserRepository
     */
    protected $users;

    /**
     * @var Client
     */
    protected $apiClient;

    /**
     * @var SessionAuthenticator
     */
    protected $authenticator;

    /**
     * @var Rememberer
     */
    protected $rememberer;

    /**
     * @param \Flarum\User\UserRepository $users
     * @param Client                      $apiClient
     * @param SessionAuthenticator        $authenticator
     * @param Rememberer                  $rememberer
     */
    public function __construct(UserRepository $users, Client $apiClient, SessionAuthenticator $authenticator, Rememberer $rememberer)
    {
        $this->users = $users;
        $this->apiClient = $apiClient;
        $this->authenticator = $authenticator;
        $this->rememberer = $rememberer;
    }

    /**
     * @param Request $request
     *
     * @throws \Exception
     *
     * @return ResponseInterface
     */
    public function handle(Request $request): ResponseInterface
    {
        $actor = $request->getAttribute('actor');
        $body = $request->getParsedBody();
        $params = array_only($body, ['identification', 'password', 'twofactor', 'pageId']);

        $response = $this->apiClient->send(TokenController::class, $actor, [], $params);

        $data = json_decode($response->getBody());

        if (!isset($data->errors) && !in_array($data->userId, ['IncorrectCode', 'IncorrectOneCode'])) {
            if (200 === $response->getStatusCode()) {
                $session = $request->getAttribute('session');
                $this->authenticator->logIn($session, $data->userId);

                $token = AccessToken::find($data->token);

                event(new LoggedIn($this->users->findOrFail($data->userId), $token));

                if (array_get($body, 'remember')) {
                    $response = $this->rememberer->remember($response, $token);
                }
            }
        }

        return $response;
    }
}
