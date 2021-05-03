<?php

/*
 * This file is part of fof/cookie-consent.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
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
            'backgroundColor',
            'buttonBackgroundColor',
            'buttonText',
            'buttonTextColor',
            'ccTheme',
            'consentText',
            'learnMoreLinkText',
            'learnMoreLinkUrl',
            'textColor', ];

        foreach ($keys as $key) {
            if ($value = $settings->get($full = "reflar-cookie-consent.$key")) {
                $settings->set("fof-cookie-consent.$key", $value);
                $settings->delete($full);
            }
        }
    },
    'down' => function (Builder $schema) {
        // Do nothing
    },
];
