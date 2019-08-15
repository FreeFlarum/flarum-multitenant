<?php

/* This is part of the jordanjay/flarum-ext-summaries project.
 *
 * Modified code (c)2019 Jordan Schnaidt
 *
 * Original code (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JordanJay29\Summaries;

use Flarum\Extend;
use Illuminate\Contracts\Events\Dispatcher;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/resources/less/forum/extension.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    function (Dispatcher $events) {
        $events->subscribe(Listeners\AddApiAttributes::class);
        $events->subscribe(Listeners\LoadUserSettings::class);
    }];
