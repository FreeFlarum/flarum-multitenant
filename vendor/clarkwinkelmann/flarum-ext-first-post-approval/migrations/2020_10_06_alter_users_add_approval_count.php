<?php

use Flarum\Database\Migration;

return Migration::addColumns('users', [
    'first_post_approval_count' => ['tinyInteger', 'unsigned' => true, 'default' => 0],
    'first_discussion_approval_count' => ['tinyInteger', 'unsigned' => true, 'default' => 0],
]);
