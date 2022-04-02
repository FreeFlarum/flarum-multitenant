<?php

use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        /**
         * @var \Flarum\Settings\SettingsRepositoryInterface
         */
        $settings = resolve('flarum.settings');

        $value = $settings->get($key = 'justoverclock-hashtag.regex');

        if (isset($value)) {
            $settings->set('justoverclock-hashtag.regex.old', $value);
            $settings->delete($key);
        }
    },
    'down' => function (Builder $schema) {
        // ...
    }
];
