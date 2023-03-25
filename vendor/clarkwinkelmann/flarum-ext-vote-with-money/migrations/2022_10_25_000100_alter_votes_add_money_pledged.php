<?php

use Flarum\Database\Migration;

return Migration::addColumns('poll_votes', [
    'money_pledged' => ['integer', 'unsigned' => true, 'nullable' => true],
]);
