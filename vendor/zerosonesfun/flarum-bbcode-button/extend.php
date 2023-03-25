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
    ->serializeToForum('zerosonesfun-bbcode-button.icon', 'zerosonesfun-bbcode-button.icon')
    ->serializeToForum('zerosonesfun-bbcode-button.code2', 'zerosonesfun-bbcode-button.code2')
    ->serializeToForum('zerosonesfun-bbcode-button.icon2', 'zerosonesfun-bbcode-button.icon2')
    ->serializeToForum('zerosonesfun-bbcode-button.code3', 'zerosonesfun-bbcode-button.code3')
    ->serializeToForum('zerosonesfun-bbcode-button.icon3', 'zerosonesfun-bbcode-button.icon3')
    ->serializeToForum('zerosonesfun-bbcode-button.intro', 'zerosonesfun-bbcode-button.intro')
];
