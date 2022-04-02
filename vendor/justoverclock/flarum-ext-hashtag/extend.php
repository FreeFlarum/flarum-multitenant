<?php

/*
 * This file is part of justoverclock/flarum-ext-hashtag.
 *
 * Copyright (c) 2021 Marco Colia.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Justoverclock\Hashtag;

use Flarum\Extend;
use Flarum\Settings\Event\Saving as SettingsSaving;
use s9e\TextFormatter\Configurator;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),
    new Extend\Locales(__DIR__.'/resources/locale'),
    (new Extend\Formatter())
        ->configure(function (Configurator $configurator) {
            $configurator->plugins->set('Hashtag', Plugins\Hashtag\Configurator::class);
        }),

    (new Extend\Event())
        ->listen(SettingsSaving::class, function (SettingsSaving $event) {
            foreach ($event->settings as $key => $setting) {
                if ($key === 'justoverclock-hashtag.regex' || $key === 'default_route') {
                    resolve('flarum.formatter')->flush();

                    return;
                }
            }
        }),
];
