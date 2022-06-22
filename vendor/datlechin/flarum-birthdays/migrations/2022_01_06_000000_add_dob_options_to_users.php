<?php

use Flarum\Database\Migration;

return Migration::addColumns('users', [
    'showDobDate' => ['type' => 'boolean', 'default' => 1],
    'showDobYear' => ['type' => 'boolean', 'default' => 1],
]);
