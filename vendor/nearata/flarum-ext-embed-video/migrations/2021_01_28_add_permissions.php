<?php

use Flarum\Database\Migration;
use Flarum\Group\Group;

return Migration::addPermissions([
    'nearata.embedvideo.create' => Group::MEMBER_ID
]);
