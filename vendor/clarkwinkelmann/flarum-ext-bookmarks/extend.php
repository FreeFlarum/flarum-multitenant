<?php

namespace ClarkWinkelmann\Bookmarks;

use ClarkWinkelmann\Bookmarks\Listeners\SaveDiscussion;
use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Discussion\Discussion;
use Flarum\Discussion\Event\Saving;
use Flarum\Discussion\Search\DiscussionSearcher;
use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/resources/less/forum.less')
        ->route('/bookmarks', 'bookmark', Content\Bookmarks::class),

    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\Event())
        ->listen(Saving::class, SaveDiscussion::class),

    (new Extend\ApiSerializer(DiscussionSerializer::class))
        ->attribute('bookmarked', function (DiscussionSerializer $serializer, Discussion $discussion): bool {
            return $discussion->state ? !is_null($discussion->state->bookmarked_at) : false;
        }),

    (new Extend\Settings())
        ->serializeToForum('independentBookmarkButton', 'bookmarks.independentButton', function ($value): bool {
            return $value !== '0';
        }),

    (new Extend\SimpleFlarumSearch(DiscussionSearcher::class))
        ->addGambit(Gambits\BookmarkedGambit::class),
];
