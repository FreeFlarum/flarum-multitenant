<?php

/*
 * This file is part of fof/default-user-preferences.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\DefaultUserPreferences;

use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Extend;
use Flarum\User\Event\Registered;
use FoF\DefaultUserPreferences\Providers\DefaultUserPreferencesProvider;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less'),

    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\Event())
        ->listen(Registered::class, Listeners\ApplyDefaultPreferences::class),

    (new Extend\ServiceProvider())
        ->register(DefaultUserPreferencesProvider::class),

    (new Extend\ApiSerializer(ForumSerializer::class))
        ->attributes(function (ForumSerializer $serializer, $model, array $attributes): array {
            if ($serializer->getActor()->isAdmin()) {
                $attributes['fof-default-user-preferences'] = resolve('fof-default-user-preferences');
            }

            return $attributes;
        }),
];
