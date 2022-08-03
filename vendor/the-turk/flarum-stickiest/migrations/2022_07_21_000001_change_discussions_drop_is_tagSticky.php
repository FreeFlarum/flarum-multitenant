<?php

/*
 * This file is part of Stickiest.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

use Flarum\Database\Migration;

return Migration::dropColumns('discussions', [
    'is_tagSticky' => ['boolean', 'default' => 0],
]);
