<?php

/*
 * This file is part of datlechin/flarum-landing-page.
 *
 * Copyright (c) 2022 Ngo Quoc Dat.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Datlechin\LandingPage;

use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    new Extend\Locales(__DIR__ . '/locale'),

    (new Extend\Settings())
        ->serializeToForum('datlechin-landing-page.headerHTML', 'datlechin-landing-page.header_html')
        ->serializeToForum('datlechin-landing-page.bodyHTML', 'datlechin-landing-page.body_html')
];
