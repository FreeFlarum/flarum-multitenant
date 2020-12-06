<?php

/*
 * This file is part of fof/stopforumspam.
 *
 * Copyright (c) 2019 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        /**
         * @var SettingsRepositoryInterface
         */
        $settings = app('flarum.settings');
        $keys = ['username', 'email', 'ip', 'frequency', 'api_key'];

        foreach ($keys as $key) {
            if (($value = $settings->get($full = "sfs.$key")) != null) {
                $settings->set("fof-stopforumspam.$key", $value);
                $settings->delete($full);
            }
        }
    },
    'down' => function (Builder $schema) {
        // Do nothing
    },
];
