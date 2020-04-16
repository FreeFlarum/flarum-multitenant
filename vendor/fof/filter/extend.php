<?php
/**
 *  This file is part of fof/filter.
 *
 *  Copyright (c) 2020 FriendsOfFlarum..
 *
 *  For the full copyright and license information, please view the license.md
 *  file that was distributed with this source code.
 */

namespace FoF\Filter;

use Flarum\Extend;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\View\Factory;

return [
    (new Extend\Frontend('admin'))
        ->css(__DIR__.'/resources/less/admin/WordConfigPage.less')
        ->js(__DIR__.'/js/dist/admin.js'),
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js'),
    new Extend\Locales(__DIR__.'/resources/locale'),
    new Extend\Compat(function (Dispatcher $events, Factory $views) {
        $events->subscribe(Listener\FilterPosts::class);
        $events->subscribe(Listener\AddCensorChecks::class);

        $views->addNameSpace('fof-filter', __DIR__.'/views');
    }),
];
