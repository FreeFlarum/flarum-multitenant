<?php

/*
 * This file is part of Stickiest.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

use Flarum\Database\Migration;

return Migration::addColumns('discussions', [
    // this indicates the super sticky status of a discussion.
    'is_stickiest' => ['boolean', 'default' => 0],

    // and this indicates the tag sticky status of a discussion.
    'is_tagSticky' => ['boolean', 'default' => 0],
]);
