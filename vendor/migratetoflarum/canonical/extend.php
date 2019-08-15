<?php

namespace MigrateToFlarum\Canonical;

use Flarum\Extend;
use MigrateToFlarum\Canonical\Extend\Middlewares;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js')
        ->css(__DIR__ . '/resources/less/admin.less'),
    new Extend\Locales(__DIR__ . '/resources/locale'),
    new Middlewares,
];
