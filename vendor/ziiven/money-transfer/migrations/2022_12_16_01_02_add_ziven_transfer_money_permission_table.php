<?php

use Flarum\Database\Migration;
use Flarum\Group\Group;

return Migration::addPermissions([
    'transferMoney.allowUseTranferMoney' => Group::MEMBER_ID,
]);
