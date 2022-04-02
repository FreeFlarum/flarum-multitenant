<?php

/*
 * This file is part of justoverclock/last-tweet.
 *
 * Copyright (c) 2021 Marco Colia.
 * https://flarum.it
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Justoverclock\LastTweet;

use Flarum\Extend;
use Flarum\Frontend\Document;
use Flarum\Api\Event\Serializing;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less')
        ->content(function (Document $document) {
            $document->head[] = '<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>';
        }),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less'),
    new Extend\Locales(__DIR__.'/locale'),
    (new Extend\Settings)
        ->serializeToForum('tweet_number', 'justoverclock-last-tweet.tweet_number'),
    (new Extend\Settings)
        ->serializeToForum('justoverclock-last-tweet.theme', 'justoverclock-last-tweet.theme'),
    (new Extend\Settings)
        ->serializeToForum('twhref', 'justoverclock-last-tweet.twhref'),
];
