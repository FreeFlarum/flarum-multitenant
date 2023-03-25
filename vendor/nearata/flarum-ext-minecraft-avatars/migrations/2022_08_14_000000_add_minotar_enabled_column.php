<?php

use Flarum\Database\Migration;

return Migration::addColumns('users', [
    'minotar_enabled' => ['boolean', 'default' => false]
]);
