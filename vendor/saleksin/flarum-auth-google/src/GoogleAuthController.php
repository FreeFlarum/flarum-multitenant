<?php

/*
 * This file is part of Flarum.
 *
 * (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Saleksin\Auth\Google;

use Exception;
use Flarum\Forum\Auth\Registration;
use Flarum\Forum\Auth\ResponseFactory;
use Flarum\Settings\SettingsRepositoryInterface;
use League\OAuth2\Client\Provider\Google;
use League\OAuth2\Client\Provider\GoogleUser;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class GoogleAuthController implements RequestHandlerInterface
{
    /**
     * @var ResponseFactory
     */
    protected $response;

    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @param ResponseFactory $response
     */
    public function __construct(ResponseFactory $response, SettingsRepositoryInterface $settings)
    {
        $this->response = $response;
        $this->settings = $settings;
    }

    /**
     * @param Request $request
     * @return ResponseInterface
     * @throws \League\OAuth2\Client\Provider\Exception\GoogleProviderException
     * @throws Exception
     */
    public function handle(Request $request): ResponseInterface
    {
        $conf = app('flarum.config');
        $redirectUri = $conf['url'] . "/auth/google";

        $provider = new Google([
            'clientId' => trim($this->settings->get('saleksin-auth-google.client_id')),
            'clientSecret' => trim($this->settings->get('saleksin-auth-google.client_secret')),
            'redirectUri' => $redirectUri,
            'approvalPrompt'  => 'force',
            'hostedDomain'    => null,
            'accessType'      => 'offline',
        ]);

        $session = $request->getAttribute('session');
        $queryParams = $request->getQueryParams();

        $code = array_get($queryParams, 'code');

        if (! $code) {
            $authUrl = $provider->getAuthorizationUrl();
            $session->put('oauth2state', $provider->getState());

            return new RedirectResponse($authUrl.'&display=popup');
        }

        $state = array_get($queryParams, 'state');

        if (! $state || $state !== $session->get('oauth2state')) {
            $session->remove('oauth2state');

            throw new Exception('Invalid state');
        }

        $token = $provider->getAccessToken('authorization_code', compact('code'));

        /** @var GoogleUser $user */
        $user = $provider->getResourceOwner($token);

        return $this->response->make(
            'google', $user->getId(),
            function (Registration $registration) use ($user) {
                $registration
                    ->provideTrustedEmail($user->getEmail())
                    ->provideAvatar($user->getAvatar())
                    ->suggestUsername($user->getName())
                    ->setPayload($user->toArray());
            }
        );
    }
}
