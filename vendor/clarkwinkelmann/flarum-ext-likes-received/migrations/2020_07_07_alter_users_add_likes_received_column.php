<?php

use Flarum\Database\Migration;

return Migration::addColumns('users', [
    'clarkwinkelmann_likes_received_count' => ['integer', 'unsigned' => true, 'default' => 0],
]);
