<?php

namespace ClarkWinkelmann\Status;

use Flarum\Api\Serializer\UserSerializer;
use Flarum\Extend;
use Flarum\User\Event\Saving;
use Flarum\User\User;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/resources/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\ApiSerializer(UserSerializer::class))
        ->attributes(UserAttributes::class),

    (new Extend\Event())
        ->listen(Saving::class, Listeners\SaveStatus::class),

    (new Extend\Settings())
        ->serializeToForum('clarkwinkelmannStatusOnlyCountries', 'clarkwinkelmann-status.onlyCountries', 'boolval')
        ->serializeToForum('clarkwinkelmannStatusEnableText', 'clarkwinkelmann-status.enableText', 'boolval'),

    (new Extend\Policy())
        ->modelPolicy(User::class, Policies\UserPolicy::class),
];
