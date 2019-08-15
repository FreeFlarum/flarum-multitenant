<?php

namespace Reflar\twofactor;

use Flarum\Extend;
use Illuminate\Contracts\Events\Dispatcher;
use Reflar\twofactor\Api\Controllers;

return [
    (new Extend\Frontend('forum'))
        ->css(__DIR__.'/resources/less/TwoFactor.less')
        ->js(__DIR__.'/js/dist/forum.js'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),
    new Extend\Locales(__DIR__.'/resources/locale'),
    (new Extend\Routes('api'))
        ->get('/twofactor/getsecret', 'twofactor.getsecret', Controllers\GetSecretController::class)
        ->post('/twofactor/login', 'twofactor.login', Controllers\LogInController::class)
        ->post('/twofactor/verifycode', 'twofactor.verifycode', Controllers\VerifyCodeController::class)
        ->post('/twofactor/callback', 'twofactor.callback', Controllers\OneTouchCallbackController::class),
    function (Dispatcher $events) {
        $events->subscribe(Listeners\AddApiAttributes::class);
    },
];
