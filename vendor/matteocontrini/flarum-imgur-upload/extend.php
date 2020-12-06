<?php

namespace ImgurUpload;

use Flarum\Extend;
use Flarum\Frontend\Document;
use Flarum\Api\Event\Serializing;
use Illuminate\Contracts\Events\Dispatcher;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/css/forum.css'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),
    new Extend\Locales(__DIR__.'/locale'),
    (new Extend\Event)->listen(Serializing::class, SettingsLoaderListener::class)
];
