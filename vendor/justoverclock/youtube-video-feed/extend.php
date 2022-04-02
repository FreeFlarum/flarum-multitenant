<?php

/*
 * This file is part of justoverclock/youtube-video-feed.
 *
 * Copyright (c) 2021 Marco Colia.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Justoverclock\YtVideoFeed;


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
        ->serializeToForum('justoverclock-youtube-video-feed.ytWidth', 'justoverclock-youtube-video-feed.ytWidth')
        ->serializeToForum('justoverclock-youtube-video-feed.ytHeight', 'justoverclock-youtube-video-feed.ytHeight')
        ->serializeToForum('justoverclock-youtube-video-feed.ytChannelId', 'justoverclock-youtube-video-feed.ytChannelId')
        ->serializeToForum('justoverclock-youtube-video-feed.showTitle', 'justoverclock-youtube-video-feed.showTitle', 'boolval', true),


];
