<?php

/*
 * This file is part of fof/extend.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\Extend\Controllers;

use Exception;
use Flarum\Forum\Auth\Registration;
use Flarum\Forum\Auth\ResponseFactory;
use Flarum\Foundation\ValidationException;
use Flarum\Http\RequestUtil;
use Flarum\Http\UrlGenerator;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\LoginProvider;
use Flarum\User\User;
use Illuminate\Session\Store;
use Illuminate\Support\Arr;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

abstract class AbstractOAuthController implements RequestHandlerInterface
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
     * @param ResponseFactory             $response
     * @param SettingsRepositoryInterface $settings
     * @param UrlGenerator                $url
     */
    public function __construct(ResponseFactory $response, SettingsRepositoryInterface $settings, UrlGenerator $url)
    {
        $this->response = $response;
        $this->settings = $settings;
        $this->url = $url;
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @throws Exception
     *
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $redirectUri = $this->url->to('forum')->route($this->getRouteName());
        $provider = $this->getProvider($redirectUri);

        /** @var Store $session */
        $session = $request->getAttribute('session');
        $queryParams = $request->getQueryParams();
        $code = Arr::get($queryParams, 'code');
        $state = Arr::get($queryParams, 'state');

        if ($requestLinkTo = Arr::pull($queryParams, 'linkTo')) {
            $session->put('linkTo', $requestLinkTo);
        }

        if (!$code) {
            $authUrl = $provider->getAuthorizationUrl($this->getAuthorizationUrlOptions());
            $session->put('oauth2state', $provider->getState());

            return new RedirectResponse($authUrl.'&display=popup');
        } elseif (!$state || $state !== $session->get('oauth2state')) {
            $session->remove('oauth2state');

            throw new Exception('Invalid state');
        }

        $token = $provider->getAccessToken('authorization_code', compact('code'));
        $user = $provider->getResourceOwner($token);

        if ($shouldLink = $session->remove('linkTo')) {
            // Don't register a new user, just link to the existing account, else continue with registration.
            $actor = RequestUtil::getActor($request);

            if ($actor->exists) {
                $actor->assertRegistered();

                if ($actor->id !== (int) $shouldLink) {
                    throw new ValidationException(['linkAccount' => 'User data mismatch']);
                }

                return $this->link($actor, $user);
            }
        }

        return $this->response->make(
            $this->getProviderName(),
            $this->getIdentifier($user),
            function (Registration $registration) use ($user, $token) {
                $this->setSuggestions($registration, $user, $token);
            }
        );
    }

    /**
     * Link the currently authenticated user to the OAuth account.
     *
     * @param User                   $user
     * @param ResourceOwnerInterface $resourceOwner
     *
     * @return HtmlResponse
     */
    protected function link(User $user, $resourceOwner): HtmlResponse
    {
        if (LoginProvider::where('identifier', $this->getIdentifier($resourceOwner))->where('provider', $this->getProviderName())->exists()) {
            throw new ValidationException(['linkAccount' => 'Account already linked to another user']);
        }

        $user->loginProviders()->firstOrCreate([
            'provider'   => $this->getProviderName(),
            'identifier' => $this->getIdentifier($resourceOwner),
        ])->touch();

        $content = '<script>window.close(); window.opener.location.reload();</script>';

        return new HtmlResponse($content);
    }

    /**
     * Get OAuth route name, used for redirect url
     * Example: 'auth.github'.
     *
     * @return string
     */
    abstract protected function getRouteName(): string;

    /**
     * Get League OAuth 2.0 provider.
     *
     * @param string $redirectUri
     *
     * @return AbstractProvider
     */
    abstract protected function getProvider(string $redirectUri): AbstractProvider;

    /**
     * Get League OAuth 2.0 provider name.
     *
     * @return string
     */
    abstract protected function getProviderName(): string;

    /**
     * Get authorization URL options.
     *
     * @return array
     */
    abstract protected function getAuthorizationUrlOptions(): array;

    /**
     * Get user identifier.
     *
     * @param ResourceOwnerInterface $user
     *
     * @return string
     */
    abstract protected function getIdentifier($user): string;

    /**
     * Set form suggestions.
     *
     * @param Registration           $registration
     * @param ResourceOwnerInterface $user
     * @param string                 $token
     *
     * @return void
     */
    abstract protected function setSuggestions(Registration $registration, $user, string $token);
}
