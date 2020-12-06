<?php

/*
 * This file is part of luuhai48/oauth-linkedin.
 *
 * Copyright (c) 2020 Luuhai48.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Luuhai48\OauthLinkedIn\Providers;

use Flarum\Forum\Auth\Registration;
use Flarum\Settings\SettingsRepositoryInterface;
use FoF\OAuth\Provider;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\LinkedIn as LinkedInProvider;


class LinkedIn extends Provider
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @var LinkedInProvider
     */
    protected $provider;

    public function name(): string
    {
        return 'linkedin';
    }

    public function link(): string
    {
        return 'https://linkedin.com/developers/apps/new';
    }

    public function fields(): array
    {
        return [
            'client_id'     => 'required',
            'client_secret' => 'required',
        ];
    }

    public function provider(string $redirectUri): AbstractProvider
    {
        return $this->provider = new LinkedInProvider([
            'clientId'        => $this->getSetting('client_id'),
            'clientSecret'    => $this->getSetting('client_secret'),
            'redirectUri'     => $redirectUri,
        ]);
    }

    public function suggestions(Registration $registration, $user, string $token)
    {
        $email = $user->getEmail();

        $registration
            ->provideTrustedEmail($email)
            ->suggestUsername($user->getFirstName())
            ->provideAvatar($user->getImageUrl() ?? "")
            ->setPayload($user->toArray());
    }
}
