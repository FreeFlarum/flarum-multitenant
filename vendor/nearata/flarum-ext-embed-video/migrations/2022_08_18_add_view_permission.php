<?php

use Flarum\Database\Migration;
use Flarum\Group\Group;

return Migration::addPermissions([
    'nearata.embedvideo.view' => Group::GUEST_ID
]);
