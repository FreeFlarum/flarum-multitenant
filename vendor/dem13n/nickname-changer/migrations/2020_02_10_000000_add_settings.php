<?php

use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {

        $settings = app(SettingsRepositoryInterface::class);

        if (empty($settings->get('dem13n_nickname_regex'))) {
            $settings->set('dem13n_nickname_regex', '/^([[:alnum:]]{2,}[\r\n\t\f\v ]{0,1})+$/iu');
        }

        if (empty($settings->get('dem13n_nickname_min_char'))) {
            $settings->set('dem13n_nickname_min_char', 2);
        }

        if (empty($settings->get('dem13n_nickname_max_char'))) {
            $settings->set('dem13n_nickname_max_char', 30);
        }

        if (empty($settings->get('dem13n_nickname_unique'))) {
            $settings->set('dem13n_nickname_unique', 0);
        }

    },
];
