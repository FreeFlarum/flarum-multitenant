<?php

/*
 * This file is part of ianm/synopsis.
 *
 * (c) 2020 - 2022 Ian Morland
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Flarum\Database\Migration;

return Migration::addColumns(
    'tags',
    [
        'excerpt_length' => ['integer', 'nullable' => true, 'unsigned' => true],
        'rich_excerpts'  => ['boolean', 'nullable' => true],
    ]
);
