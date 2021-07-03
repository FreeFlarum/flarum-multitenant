<?php

/*
 * This file is part of fof/cookie-consent.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        /**
         * @var \Flarum\Settings\SettingsRepositoryInterface
         */
        $settings = resolve('flarum.settings');

        $keys = [
            'backgroundColor'       => '#2b2b2b',
            'buttonBackgroundColor' => '#178e99',
            'buttonText'            => 'I Accept',
            'buttonTextColor'       => '#ffffff',
            'ccTheme'               => '#2b2b2b',
            'consentText'           => 'Change this text in your Flarum Admin Panel!',
            'learnMoreLinkText'     => 'Learn More',
            'learnMoreLinkUrl'      => 'https://learn.more/',
            'textColor'             => '#ffffff',
        ];

        foreach ($keys as $key => $value) {
            $settings->set("fof-cookie-consent.$key", $value);
        }
    },
    'down' => function (Builder $schema) {
        // Do nothing
    },
];
