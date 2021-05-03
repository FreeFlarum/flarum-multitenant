<?php

use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        /**
         * @var $settings SettingsRepositoryInterface
         */
        $settings = app(SettingsRepositoryInterface::class);

        $value = $settings->get('itnt-uitab.notifications_page');
        
        if (!is_null($value)) {
           $settings->set('itnt-uitab.notifications_page', $value);
           $settings->delete('itnt-uitab.notification_page');
        }
    },
    'down' => function (Builder $schema) {
        // Not doing anything but `down` has to be defined
    },
];