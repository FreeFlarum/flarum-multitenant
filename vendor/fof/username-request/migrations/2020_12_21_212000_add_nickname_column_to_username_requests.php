<?php

/*
 * This file is part of fof/username-request.
 *
 * Copyright (c) 2019 - 2021 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use Flarum\Database\Migration;

return Migration::addColumns('username_requests', [
    'for_nickname' => [
        'type'    => 'boolean',
        'default' => false,
    ],
]);
