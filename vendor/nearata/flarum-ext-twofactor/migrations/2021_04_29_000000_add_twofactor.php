<?php

use Flarum\Database\Migration;

return Migration::addColumns('users', [
    'twofa_secret' => ['string', 'length' => 120],
    'twofa_active' => ['boolean', 'default' => false],
    'twofa_codes' => ['string', 'length' => 200]
]);
