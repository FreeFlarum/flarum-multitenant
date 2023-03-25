<?php

/*
 * This file is part of ianm/synopsis.
 *
 * (c) 2020 - 2022 Ian Morland
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        // No longer required, default settings are now set in extend.php
    },
    'down' => function (Builder $schema) {
        // Do nothing
    },
];
