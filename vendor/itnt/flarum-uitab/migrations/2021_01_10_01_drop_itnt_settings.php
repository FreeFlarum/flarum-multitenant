<?php

use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        /**
         * @var $settings SettingsRepositoryInterface
         */
        $settings = app(SettingsRepositoryInterface::class);

        foreach ([
                    'create_page',
                    'home_page',
                    'tags_page',
                    'settings_page',
                    'notifications_page'
                 ] as $key) {
                $settings->delete('itnt-uitab.' . $key);
        }
    },
    'down' => function (Builder $schema) {
        // Not doing anything but `down` has to be defined
    },
];