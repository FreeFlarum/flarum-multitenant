<?php

/*
 * This file is part of fof/default-group.
 *
 * Copyright (c) 2018 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace FoF\DefaultGroup;

use Flarum\Extend;
use Flarum\User\Event\Activated;
use Illuminate\Events\Dispatcher;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),
    new Extend\Locales(__DIR__ . '/resources/locale'),
    function (Dispatcher $events) {
        $events->listen(Activated::class, Listeners\AddDefaultGroup::class);
    }
];
