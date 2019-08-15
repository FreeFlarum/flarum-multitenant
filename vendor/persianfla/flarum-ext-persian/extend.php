<?php

use PersianFla\Persian\Listener;
use Illuminate\Contracts\Events\Dispatcher;

return [
    new Flarum\Extend\LanguagePack,
    function (Dispatcher $events) {
        $events->subscribe(Listener\UpdateDiscussionSlug::class);
    },
];
