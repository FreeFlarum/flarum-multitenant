<?php

/*
 * This file is part of fof/transliterator
 *
 * Copyright (c) 2018 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\Transliterator;

use Flarum\Discussion\Event\Saving;
use Flarum\Extend;
use Flarum\Frontend\Document;
use Illuminate\Events\Dispatcher;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->content(function (Document $document) {
            $document->payload['fof-transliterator.packages'] = array_keys(Transliterator::$transliterators);
        }),
    new Extend\Locales(__DIR__.'/locale'),
    (new Extend\Routes('api'))
        ->post('/fof/transliterator/parse', 'fof.transliterator.parse', Controllers\ParseOldDiscussionsController::class),
    function (Dispatcher $events) {
        $events->listen(Saving::class, Listeners\TransliterateUrl::class);
    },
];
