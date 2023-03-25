<?php

/*
 * This file is part of fof/discussion-thumbnail.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace FoF\DiscussionThumbnail;

use Flarum\Api\Serializer\BasicDiscussionSerializer;
use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    new Extend\Locales(__DIR__.'/resources/locale'),

    (new Extend\ApiSerializer(BasicDiscussionSerializer::class))
        ->attributes(Listener\AddDiscussionThumbnail::class),

    (new Extend\Settings())
        ->serializeToForum('fof-discussion-thumbnail.link_to_discussion', 'fof-discussion-thumbnail.link_to_discussion', 'boolval', false),
];
