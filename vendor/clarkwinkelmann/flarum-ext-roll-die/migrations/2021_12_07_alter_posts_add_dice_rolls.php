<?php

use Flarum\Database\Migration;

return Migration::addColumns('posts', [
    'dice_rolls' => ['string', 'length' => 255, 'nullable' => true],
]);
