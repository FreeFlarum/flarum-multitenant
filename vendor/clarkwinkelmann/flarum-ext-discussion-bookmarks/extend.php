<?php

namespace ClarkWinkelmann\DiscussionBookmarks;

use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Discussion\Discussion;
use Flarum\Discussion\Event\Saving;
use Flarum\Discussion\Search\DiscussionSearcher;
use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/resources/less/forum.less')
        ->route('/bookmarked-discussions', 'discussion-bookmarks', Content\Bookmarks::class),

    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\Event())
        ->listen(Saving::class, Listeners\SaveDiscussion::class),

    (new Extend\ApiSerializer(DiscussionSerializer::class))
        ->attribute('bookmarked', function (DiscussionSerializer $serializer, Discussion $discussion): bool {
            return $discussion->state ? !is_null($discussion->state->bookmarked_at) : false;
        }),

    (new Extend\Settings())
        ->default('discussion-bookmarks.independentButton', '1')
        ->serializeToForum('independentDiscussionBookmarkButton', 'discussion-bookmarks.independentButton', 'boolval'),

    (new Extend\SimpleFlarumSearch(DiscussionSearcher::class))
        ->addGambit(Gambits\BookmarkedGambit::class),
];
