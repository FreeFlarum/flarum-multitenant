<?php

namespace MigrateToFlarum\Canonical;

use Flarum\Extend;
use Flarum\Http\Middleware\ParseJsonBody;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js')
        ->css(__DIR__ . '/resources/less/admin.less'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\Middleware('forum'))
        ->insertBefore(ParseJsonBody::class, Middlewares\CanonicalRedirectMiddleware::class),
    (new Extend\Middleware('admin'))
        ->insertBefore(ParseJsonBody::class, Middlewares\CanonicalRedirectMiddleware::class),
];
