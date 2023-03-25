<?php

namespace ClarkWinkelmann\MoneyToAll;

use Flarum\Extend;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js'),

    (new Extend\Routes('api'))
        ->post('/money-to-all', 'money-to-all', Controllers\SendMoney::class),

    new Extend\Locales(__DIR__ . '/locale'),

    (new Extend\Notification())
        ->type(Notifications\MoneyReceivedBlueprint::class, RecordSerializer::class, ['alert']),
];
