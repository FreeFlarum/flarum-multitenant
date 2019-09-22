<?php

/*
 * This file is part of nomiscz/flarum-ext-auth-steam.
 *
 * Copyright (c) 2019 NomisCZ.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace NomisCZ\SteamAuth;

use NomisCZ\SteamAuth\Http\Controllers\SteamAuthController;
use NomisCZ\SteamAuth\Api\Controllers\SteamLinkController;
use NomisCZ\SteamAuth\Api\Controllers\SteamUnlinkController;
use NomisCZ\SteamAuth\Listeners\AddUserLoginProviderAttribute;
use Flarum\Extend;
use Illuminate\Contracts\Events\Dispatcher;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),
    new Extend\Locales(__DIR__ . '/resources/locale'),
    (new Extend\Routes('forum'))
        ->get('/auth/steam', 'auth.steam', SteamAuthController::class),
    (new Extend\Routes('api'))
        ->get('/auth/steam/link', 'auth.steam.api.link', SteamLinkController::class)
        ->post('/auth/steam/unlink', 'auth.steam.api.unlink', SteamUnlinkController::class),
    function (Dispatcher $events) {
        $events->subscribe(AddUserLoginProviderAttribute::class);
    },
];
