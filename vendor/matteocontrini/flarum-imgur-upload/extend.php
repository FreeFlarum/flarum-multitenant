<?php

namespace ImgurUpload;

use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/resources/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),
    new Extend\Locales(__DIR__ . '/locale'),
    (new Extend\Settings)
        ->serializeToForum('imgur-upload.client-id', 'imgur-upload.client-id')
        ->serializeToForum('imgur-upload.hide-markdown-image', 'imgur-upload.hide-markdown-image')
        ->serializeToForum('imgur-upload.embed-type', 'imgur-upload.embed-type')
        ->serializeToForum('imgur-upload.allow-paste', 'imgur-upload.allow-paste')
];
