<?php

/*
 * This file is part of fof/prevent-necrobumping.
 *
 * Copyright (c) 2018 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace FoF\PreventNecrobumping;

use Flarum\Extend as Vanilla;
use FoF\Components\Extend\AddFofComponents;
use FoF\Extend\Extend;
use Illuminate\Events\Dispatcher;

return [
    new AddFofComponents(),
    (new Vanilla\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),
    (new Vanilla\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),
    new Vanilla\Locales(__DIR__.'/resources/locale'),
    (new Extend\ExtensionSettings())
        ->setPrefix('fof-prevent-necrobumping.')
        ->addKeys(['message.title', 'message.description', 'message.agreement']),
    function (Dispatcher $events) {
        $events->subscribe(Listeners\ValidateNecrobumping::class);
    },
];
