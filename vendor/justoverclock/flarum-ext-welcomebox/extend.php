<?php

/*
 * This file is part of justoverclock/flarum-ext-welcomebox.
 *
 * Copyright (c) Marco Colia.
 * https://flarum.it
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Justoverclock\Welcomebox;

use Flarum\Extend;
use Flarum\Api\Event\Serializing;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/resources/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),
    new Extend\Locales(__DIR__ . '/resources/locale'),
    (new Extend\Settings())->serializeToForum('HideGuestBox', 'justoverclock-welcomebox.hide.guestbox', 'boolval', false),
    (new Extend\Settings())->serializeToForum('justoverclock-welcomebox.UseWidget', 'justoverclock-welcomebox.UseWidget', 'boolval', false),
    (new Extend\Settings)->serializeToForum('imgUrl', 'justoverclock-welcomebox.imgUrl'),
];
