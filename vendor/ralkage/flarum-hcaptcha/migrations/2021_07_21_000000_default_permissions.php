<?php

use Flarum\Database\Migration;
use Flarum\Group\Group;

return Migration::addPermissions([
    // Allow all members, effectively disabling the post hCaptcha by default
    'ralkage-hcaptcha.postWithoutHCaptcha' => Group::MEMBER_ID,
]);
