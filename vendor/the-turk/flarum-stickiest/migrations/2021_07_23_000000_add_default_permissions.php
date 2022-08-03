<?php

/*
 * This file is part of Stickiest.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

use Flarum\Database\Migration;
use Flarum\Group\Group;

return Migration::addPermissions([
    'discussion.stickiest'           => Group::MODERATOR_ID,
    'discussion.stickiest.tagSticky' => Group::MODERATOR_ID,
]);
