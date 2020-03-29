<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

use Flarum\User\User;

return [
    'up' => function () {
        foreach (User::whereNotNull('twitter_id')->cursor() as $user) {
            $user->loginProviders()->create([
                'provider' => 'twitter',
                'identifier' => $user->twitter_id
            ]);
        }
    },
    'down' => function () {
        // do nothing
    }
];
