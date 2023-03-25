<?php

use Flarum\Database\Migration;

return Migration::addColumns('polls', [
    'vote_with_money' => ['boolean', 'default' => false],
    'money_vote_min' => ['integer', 'unsigned' => true, 'nullable' => true],
    'money_vote_max' => ['integer', 'unsigned' => true, 'nullable' => true],
]);
