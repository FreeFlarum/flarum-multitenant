<?php

/*
 * This file is part of jslirola/flarum-ext-login2seeplus. 
 *
 * Copyright (c) 2020
 * Original Extension by WiseClock 
 * Updated by jslirola
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JSLirola\Login2SeePlus;

use Flarum\Extend;
use Flarum\Api\Event\Serializing;
use Illuminate\Contracts\Events\Dispatcher;
use JSLirola\Login2SeePlus\Listeners\LoadSettingsFromDatabase;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/less/login2seeplus.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js')
        ->css(__DIR__ . '/less/login2seeplus-settings.less'),

    new Extend\Locales(__DIR__ . '/locale'),

    function (Dispatcher $events) {
        $events->listen(Serializing::class, LoadSettingsFromDatabase::class);
    }

];