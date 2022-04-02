<?php

use Flarum\Database\Migration;

return Migration::addSettings([
    'xelson-chat.settings.charlimit' => 512,
    'xelson-chat.settings.floodgate.number' => 3,
    'xelson-chat.settings.floodgate.time' => '1 hour'
]);