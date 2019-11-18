<?php

/*
 * This file is part of fof/auth-discord.
 *
 * Copyright (c) 2019 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace FoF\AuthDiscord\Controllers;

use Flarum\Forum\Auth\Registration;
use FoF\Extend\Controllers\AbstractOAuthController;
use League\OAuth2\Client\Provider\AbstractProvider;
use Wohali\OAuth2\Client\Provider\Discord;
use Wohali\OAuth2\Client\Provider\DiscordResourceOwner;

class DiscordAuthController extends AbstractOAuthController
{
    /**
     * {@inheritdoc}
     */
    protected function getRouteName(): string
    {
        return 'auth.discord';
    }

    /**
     * {@inheritdoc}
     */
    protected function getProvider(string $redirectUri): AbstractProvider
    {
        return new Discord([
            'clientId'     => $this->settings->get('fof-auth-discord.client_id'),
            'clientSecret' => $this->settings->get('fof-auth-discord.client_secret'),
            'redirectUri'  => $redirectUri,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getProviderName(): string
    {
        return 'discord';
    }

    /**
     * {@inheritdoc}
     */
    protected function getAuthorizationUrlOptions(): array
    {
        return ['scope' => ['identify', 'email']];
    }

    /**
     * {@inheritdoc}
     */
    protected function getIdentifier($user): string
    {
        return $user->getId();
    }

    /**
     * {@inheritdoc}
     */
    protected function setSuggestions(Registration $registration, $user, string $token)
    {
        $registration
            ->provideTrustedEmail($user->getEmail())
            ->provideAvatar($this->getAvatar($user))
            ->suggestUsername($user->getUsername())
            ->setPayload($user->toArray());
    }

    private function getAvatar(DiscordResourceOwner $user)
    {
        $hash = $user->getAvatarHash();

        return isset($hash) ? "https://cdn.discordapp.com/avatars/{$user->getId()}/{$user->getAvatarHash()}.png" : 'https://cdn.discordapp.com/embed/avatars/0.png';
    }
}
