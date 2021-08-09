<?php

/*
 * This file is part of Afrux Online Users Widget.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

use Flarum\Database\Migration;

return Migration::addSettings([
    'afrux-online-users-widget.max_users' => '15',
]);
