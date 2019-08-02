<?php

/*
 * This file is part of Flarum.
 *
 * (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Flarum\Auth\Twitter;

use Flarum\Forum\Auth\Registration;
use Flarum\Forum\Auth\ResponseFactory;
use Flarum\Http\UrlGenerator;
use Flarum\Settings\SettingsRepositoryInterface;
use League\OAuth1\Client\Server\Twitter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class TwitterAuthController implements RequestHandlerInterface
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
     * @var UrlGenerator
     */
    protected $url;

    /**
     * @param ResponseFactory $response
     * @param SettingsRepositoryInterface $settings
     * @param UrlGenerator $url
     */
    public function __construct(ResponseFactory $response, SettingsRepositoryInterface $settings, UrlGenerator $url)
    {
        $this->response = $response;
        $this->settings = $settings;
        $this->url = $url;
    }

    /**
     * @param Request $request
     * @return ResponseInterface
     */
    public function handle(Request $request): ResponseInterface
    {
        $redirectUri = $this->url->to('forum')->route('auth.twitter');

        $server = new Twitter([
            'identifier' => $this->settings->get('flarum-auth-twitter.api_key'),
            'secret' => $this->settings->get('flarum-auth-twitter.api_secret'),
            'callback_uri' => $redirectUri
        ]);

        $session = $request->getAttribute('session');

        $queryParams = $request->getQueryParams();
        $oAuthToken = array_get($queryParams, 'oauth_token');
        $oAuthVerifier = array_get($queryParams, 'oauth_verifier');

        if (! $oAuthToken || ! $oAuthVerifier) {
            $temporaryCredentials = $server->getTemporaryCredentials();

            $session->put('temporary_credentials', serialize($temporaryCredentials));

            $authUrl = $server->getAuthorizationUrl($temporaryCredentials);

            return new RedirectResponse($authUrl);
        }

        $temporaryCredentials = unserialize($session->get('temporary_credentials'));

        $tokenCredentials = $server->getTokenCredentials($temporaryCredentials, $oAuthToken, $oAuthVerifier);

        $user = $server->getUserDetails($tokenCredentials);

        return $this->response->make(
            'twitter', $user->uid,
            function (Registration $registration) use ($user) {
                $registration
                    ->provideTrustedEmail($user->email)
                    ->provideAvatar(str_replace('_normal', '', $user->imageUrl))
                    ->suggestUsername($user->nickname)
                    ->setPayload(get_object_vars($user));
            }
        );
    }
}
