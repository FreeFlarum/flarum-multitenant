<?php

/*
 * This file is part of blomstra/mark-unread.
 *
 * Copyright (c) 2021 Blomstra Ltd.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\MarkUnread;

use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Discussion\Discussion;
use Flarum\Discussion\Event\Saving;
use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\ApiSerializer(DiscussionSerializer::class))
        ->attribute('canMarkUnread', function (DiscussionSerializer $serializer, Discussion $discussion, array $attributes) {
            return $serializer->getActor()->can('markUnread', $discussion);
        }),

    (new Extend\Event())
        ->listen(Saving::class, Listeners\MarkUnread::class),
];
