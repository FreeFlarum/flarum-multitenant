<?php

namespace Akr\Chevereto;

use Flarum\Extend;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js'),
    new Extend\Locales(__DIR__ . '/resources/locale'),
    (new Extend\Settings)
        ->serializeToForum('akr-chevereto.url', 'akr-chevereto.url')
        ->serializeToForum('akr-chevereto.insert_type', 'akr-chevereto.insert_type', function ($value) {
            if (!$value) {
                $value = 'markdown-embed-full';
            }
            return $value;
        })
];
