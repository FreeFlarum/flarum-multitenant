<?php

/*
 * This file is part of opuses114514/youtube-video-feed.
 *
 * Copyright (c) 2021 Marco Colia.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Opuses114514\YtVideoFeed;


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
    (new Extend\Settings)
        ->serializeToForum('opuses114514-youtube-video-feed.ytWidth', 'opuses114514-youtube-video-feed.ytWidth')
        ->serializeToForum('opuses114514-youtube-video-feed.ytHeight', 'opuses114514-youtube-video-feed.ytHeight')
        ->serializeToForum('opuses114514-youtube-video-feed.ytChannelId', 'opuses114514-youtube-video-feed.ytChannelId')
        ->serializeToForum('opuses114514-youtube-video-feed.showTitle', 'opuses114514-youtube-video-feed.showTitle', 'boolval', true),


];
