<?php

/*
 * This file is part of zerosonesfun/flarum-bbcode-button.
 *
 * Copyright (c) 2021 Billy Wilcosky.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace ZerosOnesFun\BBcodeButton;

use Flarum\Extend;
use Flarum\Api\Event\Serializing;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less'),
    new Extend\Locales(__DIR__.'/locale'),
    (new Extend\Settings())
    ->serializeToForum('zerosonesfun-bbcode-button.code', 'zerosonesfun-bbcode-button.code')
    ->serializeToForum('zerosonesfun-bbcode-button.pos', 'zerosonesfun-bbcode-button.pos')
];
