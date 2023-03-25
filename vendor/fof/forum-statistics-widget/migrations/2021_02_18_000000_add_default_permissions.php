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
use Flarum\Group\Group;

return
    Migration::addPermissions([
        'fof-forum-statistics-widget.viewWidget.discussionsCount' => Group::GUEST_ID,
        'fof-forum-statistics-widget.viewWidget.postsCount'       => Group::GUEST_ID,
        'fof-forum-statistics-widget.viewWidget.usersCount'       => Group::GUEST_ID,
        'fof-forum-statistics-widget.viewWidget.latestMember'     => Group::GUEST_ID,
    ]);
