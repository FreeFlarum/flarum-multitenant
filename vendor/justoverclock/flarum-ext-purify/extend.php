<?php

/*
 * This file is part of justoverclock/flarum-ext-purify.
 *
 * Copyright (c) 2021 Marco Colia.
 * https://flarum.it
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Justoverclock\Purify;

use Flarum\Extend;
use Flarum\Api\Event\Serializing;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),
    new Extend\Locales(__DIR__.'/resources/locale'),
    (new Extend\Settings)
        ->serializeToForum('addItemToArray', 'justoverclock-purify.addItemToArray'),
    (new Extend\Settings)
        ->serializeToForum('regexcustom', 'justoverclock-purify.regexcustom'),
    (new Extend\Settings())->serializeToForum('AlsoEmail', 'justoverclock-purify.AlsoEmail', 'boolval', false),
    (new Extend\Settings())->serializeToForum('CustomRegexp', 'justoverclock-purify.CustomRegexp', 'boolval', false),
];
