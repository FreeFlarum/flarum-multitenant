<?php

/*
 * This file is part of sycho/flarum-move-posts.
 *
 * Copyright (c) 2021 Sami Mazouz.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use Flarum\Database\Migration;

return Migration::addColumns('discussions', [
    // `is_moved` is too general and might be used by another extension,
    // so we use `is_first_moved` which isn't ideal, but isn't wrong either,
    // as it's the first posted that gets moved.
    'is_first_moved' => ['boolean', 'default' => 0],
]);
