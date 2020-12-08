<?php

/*
 * This file is part of fof/default-user-preferences.
 *
 * Copyright (c) 2019 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\DefaultUserPreferences;

use Flarum\Extend;
use Flarum\User\Event\Registered;
use Flarum\User\User;

return [
    (new Extend\Event())
        ->listen(Registered::class, function (Registered $event) {
            foreach (['post', 'user'] as $key) {
                $event->user->setPreference(
                    User::getNotificationPreferenceKey("{$key}Mentioned", 'email'),
                    true
                );
            }

            $event->user->setPreference('followAfterReply', true);

            $event->user->save();
        }),
];
