<?php

/*
 * This file is part of askvortsov/flarum-discussion-templates
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

use Flarum\Database\Migration;
use Flarum\Group\Group;

return Migration::addPermissions([
    'discussion.manageOwnDiscussionReplyTemplates' => Group::MEMBER_ID,
    'discussion.manageAllReplyTemplates'           => Group::MODERATOR_ID,
]);
