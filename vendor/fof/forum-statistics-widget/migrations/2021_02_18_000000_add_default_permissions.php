<?php

use Flarum\Database\Migration;
use Flarum\Group\Group;

return
    Migration::addPermissions([
        'fof-forum-statistics-widget.viewWidget.discussionsCount' => Group::GUEST_ID,
        'fof-forum-statistics-widget.viewWidget.postsCount' => Group::GUEST_ID,
        'fof-forum-statistics-widget.viewWidget.usersCount' => Group::GUEST_ID,
        'fof-forum-statistics-widget.viewWidget.latestMember' => Group::GUEST_ID
    ]);
