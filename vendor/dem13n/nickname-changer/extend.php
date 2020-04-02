<?php

namespace Dem13n\NickName\Changer;

use Flarum\Extend;
use Illuminate\Contracts\Events\Dispatcher;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    function (Dispatcher $events) {
        $events->subscribe(Listener\AddAttributes::class);
        $events->subscribe(Listener\ChangeDisplayNameAttribute::class);
        $events->subscribe(Listener\SaveNickName::class);
    },
];
