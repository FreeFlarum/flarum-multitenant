<?php

use Flarum\Database\Migration;

return Migration::addColumns('discussion_user', [
    'bookmarked_at' => ['timestamp', 'nullable' => true],
]);
