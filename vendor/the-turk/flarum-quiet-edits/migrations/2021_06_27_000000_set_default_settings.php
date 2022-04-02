<?php

use Flarum\Database\Migration;

return Migration::addSettings([
    'the-turk-quiet-edits.grace_period' => '120',
    'the-turk-quiet-edits.ignore_case_differences' => true,
    'the-turk-quiet-edits.ignore_whitespace_differences' => true,
]);