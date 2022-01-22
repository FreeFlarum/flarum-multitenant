<?php

use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        /**
         * @var SettingsRepositoryInterface
         */
        $settings = resolve('flarum.settings');

        $settings->set('justoverclock-feedback.collect-email', false);
        $settings->set('justoverclock-feedback.position', 'right');
        $settings->set('justoverclock-feedback.backgroundColor', '#fff');
        $settings->set('justoverclock-feedback.fontColor', '#000');
    },
    'down' => function (Builder $schema) {
        //
    },
];
