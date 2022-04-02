<?php

use Flarum\Database\Migration;

return Migration::addColumns('discussions', [
    'shadow_hidden_at' => ['timestamp', 'nullable' => true, 'index' => true],
]);
