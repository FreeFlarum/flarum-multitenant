<?php

use Flarum\Database\Migration;
use Flarum\Group\Group;

return Migration::addPermissions([
    'user.editOwnBirthday' => Group::MEMBER_ID,
]);
