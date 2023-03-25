<?php

/*
 * This file is part of fof/spamblock.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\Spamblock;

use Flarum\Api\Serializer\UserSerializer;
use Flarum\Extend;
use Flarum\User\User;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\Routes('api'))
        ->post('/users/{id}/spamblock', 'users.spamblock', Controllers\MarkAsSpammerController::class),

    (new Extend\ApiSerializer(UserSerializer::class))
        ->attributes(AddPermissions::class),

    (new Extend\Policy())
        ->modelPolicy(User::class, Access\UserPolicy::class),
];
