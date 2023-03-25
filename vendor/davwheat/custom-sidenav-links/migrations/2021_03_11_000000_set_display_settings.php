<?php

/*
 * This file is part of davwheat/custom-sidenav-links.
 *
 * Copyright (c) 2021 David Wheatley.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Flarum\Database\Migration;

return Migration::addSettings([
  'davwheat-custom-sidenav-links.position' => 'above-tags-link',
  'davwheat-custom-sidenav-links.top-spacer' => true,
  'davwheat-custom-sidenav-links.bottom-spacer' => true,
]);
