<?php

/*
 * This file is part of askvortsov/flarum-checklist
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

use Flarum\Database\Migration;

return Migration::addSettings([
    'askvortsov-checklist.cross_out_completed_items' => true,
]);
