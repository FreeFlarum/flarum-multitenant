<?php

use Flarum\Database\Migration;

return Migration::addColumns('users', [
    'minotar' => ['string', 'length' => 36, 'nullable' => true]
]);
