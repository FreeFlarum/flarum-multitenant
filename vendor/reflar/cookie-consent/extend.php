<?php

/**
 *  This file is part of reflar/cookie-consent.
 *
 *  Copyright (c) ReFlar.
 *
 *  http://reflar.io
 *
 *  For the full copyright and license information, please view the license.md
 *  file that was distributed with this source code.
 */

namespace ReFlar\CookieConsent;

use Flarum\Extend;
use Flarum\Foundation\Application;
use Flarum\Frontend\Assets;
use Flarum\Frontend\Compiler\Source\SourceCollector;
use Illuminate\Contracts\Events\Dispatcher;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),
    new Extend\Locales(__DIR__.'/resources/locale'),
    function (Application $app, Dispatcher $events) {
        $events->subscribe(Listeners\LoadSettingsFromDatabase::class);

        $app->resolving('flarum.assets.forum', function (Assets $assets) use ($app) {
            if ($app['flarum.settings']->get('reflar-cookie-consent.ccTheme') != 'no_css') {
                $assets->css(function (SourceCollector $sources) {
                    $sources->addFile(__DIR__.'/resources/less/forum.less');
                });
            }
        });

    },
];
