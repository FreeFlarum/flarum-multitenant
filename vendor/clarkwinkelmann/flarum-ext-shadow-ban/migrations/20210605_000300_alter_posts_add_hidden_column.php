<?php

use Flarum\Database\Migration;

return Migration::addColumns('posts', [
    'shadow_hidden_at' => ['timestamp', 'nullable' => true, 'index' => true],
]);
