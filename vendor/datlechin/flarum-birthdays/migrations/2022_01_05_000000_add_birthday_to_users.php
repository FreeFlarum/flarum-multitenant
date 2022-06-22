<?php

use Flarum\Database\Migration;

return Migration::addColumns('users', [
    'birthday' => ['type' => 'date', 'nullable' => true],
]);
