<?php

/*
 * This file is part of davwheat/custom-sidenav-links.
 *
 * Copyright (c) 2021 David Wheatley.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Davwheat\CustomSidenavLinks;

use Flarum\Extend;
use Davwheat\CustomSidenavLinks\Extend\ExtensionSettings;

return [
  (new Extend\Frontend('forum'))->js(__DIR__ . '/js/dist/forum.js')->css(__DIR__ . '/less/forum.less'),

  (new Extend\Frontend('admin'))->js(__DIR__ . '/js/dist/admin.js')->css(__DIR__ . '/less/admin.less'),

  new Extend\Locales(__DIR__ . '/locale'),

  (new ExtensionSettings())
    ->addKey('davwheat-custom-sidenav-links.link-data')
    ->addKey('davwheat-custom-sidenav-links.position')
    ->addKey('davwheat-custom-sidenav-links.top-spacer')
    ->addKey('davwheat-custom-sidenav-links.bottom-spacer'),
];
