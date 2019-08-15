<?php

/**
 *  This file is part of fof/secure-https.
 *
 *  Copyright (c) 2018 FriendsOfFlarum
 *
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace FoF\SecureHttps;

use Flarum\Event\ConfigureMiddleware;
use Flarum\Extend;
use Illuminate\Events\Dispatcher;
use s9e\TextFormatter\Configurator;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),
    new Extend\Locales(__DIR__ . '/resources/locale'),
    (new Extend\Routes('api'))
        ->get(
            '/fof/secure-https/{imgurl}',
            'fof.secure-https.imgurl',
            Api\Controllers\GetImageUrlController::class
        ),
    (new Extend\Formatter())
        ->configure(function (Configurator $configurator) { }),
    function (Dispatcher $dispatcher) {
        $dispatcher->subscribe(Listeners\ModifyContentHtml::class);

        $dispatcher->listen(ConfigureMiddleware::class, function (ConfigureMiddleware $event) {
            $event->pipe(app(Middlewares\ContentSecurityPolicyMiddleware::class));
        });
    }
];
