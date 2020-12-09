<?php

/*
 * This file is part of fof/filter.
 *
 * Copyright (c) 2020 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 */

use Flarum\Database\Migration;

return Migration::addColumns('posts', [
    'emailed' => ['boolean', 'default' => 0],
]);
