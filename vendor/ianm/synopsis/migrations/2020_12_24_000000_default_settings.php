<?php

/*
 * This file is part of ianm/synopsis.
 *
 * (c) 2020 - 2021 Ian Morland
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
        $settings = resolve('flarum.settings');

        $settings->set('ianm-synopsis.excerpt_length', '200');
        $settings->set('ianm-synopsis.rich-excerpts', false);
        $settings->set('ianm-synopsis.excerpt-type', 'first');
    },
    'down' => function (Builder $schema) {
        // Do nothing
    },
];
