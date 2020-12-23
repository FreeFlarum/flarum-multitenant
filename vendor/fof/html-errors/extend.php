<?php

namespace FoF\HtmlErrors;

use Flarum\Extend;
use Flarum\Foundation\Application;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    new Extend\Locales(__DIR__ . '/locale'),

    function (Application $app) {
        $app->register(Providers\ErrorServiceProvider::class);
    },
];
