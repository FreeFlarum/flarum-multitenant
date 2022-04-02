<?php

use Flarum\Database\Migration;

return Migration::addColumns('users', [
    'shadow_banned_until' => ['timestamp', 'nullable' => true, 'index' => true],
]);
