<?php

use Flarum\Database\Migration;

return Migration::addColumns('users', [
    'clarkwinkelmann_status_emoji' => ['string', 'length' => 16, 'nullable' => true],
    'clarkwinkelmann_status_text' => ['string', 'length' => 250, 'nullable' => true],
]);
