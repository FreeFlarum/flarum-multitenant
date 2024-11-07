<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

$site = require '../site.php';

/*
|-------------------------------------------------------------------------------
| Accept incoming HTTP requests
|-------------------------------------------------------------------------------
|
| Every HTTP request pointed to the web server that cannot be served by simply
| responding with one of the files in the "public" directory will be sent to
| this file. Now is the time to boot up Flarum's internal HTTP server, which
| will try its best to interpret the request and return the appropriate
| response, which could be a JSON document (for API responses) or a lot of HTML.
|
*/

if (isset($_SERVER['HTTP_X_REAL_IP'])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_REAL_IP'];
} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
} elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
}

$server = new Flarum\Http\Server($site);
$server->listen();
