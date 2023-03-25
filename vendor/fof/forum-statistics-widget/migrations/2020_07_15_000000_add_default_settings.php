<?php

/*
 * This file is part of fof/forum-statistics-widget.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Flarum\Database\Migration;

return Migration::addSettings([
    'fof-forum-statistics-widget.ignore_private_discussions' => true,
    'fof-forum-statistics-widget.widget_order'               => 0,
]);
