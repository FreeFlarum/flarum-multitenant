<?php

use Flarum\Database\Migration;


return Migration::addColumns('users', [
    'location' => ['type' => 'text']
]);
