<?php

/*
 * This file is part of datlechin/flarum-scroll-buttons.
 *
 * Copyright (c) 2021 Ngo Quoc Dat.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Datlechin\ScrollButtons;

use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    new Extend\Locales(__DIR__ . '/locale'),

    (new Extend\Settings)
        ->serializeToForum('scrollToTopButton', 'datlechin-scroll-buttons.scroll-to-top-button', 'boolval')
        ->serializeToForum('scrollToBottomButton', 'datlechin-scroll-buttons.scroll-to-bottom-button', 'boolval')
        ->serializeToForum('scrollToTopIcon', 'datlechin-scroll-buttons.scroll-to-top-icon')
        ->serializeToForum('scrollToBottomIcon', 'datlechin-scroll-buttons.scroll-to-bottom-icon')
        ->default('datlechin-scroll-buttons.scroll-to-top-button', true)
        ->default('datlechin-scroll-buttons.scroll-to-bottom-button', true)
];
