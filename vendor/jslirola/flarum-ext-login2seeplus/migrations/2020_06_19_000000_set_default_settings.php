<?php

/*
 * This file is part of jslirola/flarum-ext-login2seeplus. 
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

use Flarum\Database\Migration;

return Migration::addSettings([
    'jslirola.login2seeplus.post' => '-1',
    'jslirola.login2seeplus.image' => '0',
    'jslirola.login2seeplus.link' => '1',
    'jslirola.login2seeplus.code' => '0',
    'jslirola.login2seeplus.php' => '0',
]);