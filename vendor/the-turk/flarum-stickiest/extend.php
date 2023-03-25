<?php

/*
 * This file is part of Stickiest.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

use Flarum\Api\Controller as FlarumController;
use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Discussion\Discussion;
use Flarum\Discussion\Event\Saving;
use Flarum\Discussion\Filter\DiscussionFilterer;
use Flarum\Discussion\Search\DiscussionSearcher;
use Flarum\Extend;
use Flarum\Tags\Api\Serializer\TagSerializer;
use Flarum\Tags\Event\DiscussionWasTagged;
use Flarum\Tags\Tag;
use TheTurk\Stickiest\Event\DiscussionWasSuperStickied;
use TheTurk\Stickiest\Event\DiscussionWasUnSuperStickied;
use TheTurk\Stickiest\Listener;
use TheTurk\Stickiest\Post\DiscussionSuperStickiedPost;
use TheTurk\Stickiest\Provider\PinProvider;
use TheTurk\Stickiest\Query\StickiestFilterGambit;
use TheTurk\Stickiest\Query\TagStickyFilterGambit;
use TheTurk\Stickiest\TagStickyState;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),

    (new Extend\Post())
        ->type(DiscussionSuperStickiedPost::class),

    (new Extend\Model(Discussion::class))
        ->hasMany('stickyStates', TagStickyState::class, 'discussion_id')
        ->belongsToMany('stickyTags', Tag::class, 'discussion_sticky_tag'),

    (new Extend\Model(Tag::class))
        ->hasMany('stickyStates', TagStickyState::class, 'tag_id'),

    (new Extend\ApiSerializer(DiscussionSerializer::class))
        ->hasMany('stickyTags', TagSerializer::class)
        ->attribute('isStickiest', function (DiscussionSerializer $serializer, $discussion) {
            return (bool) $discussion->is_stickiest;
        })
        ->attribute('isTagSticky', function (DiscussionSerializer $serializer, $discussion) {
            return (bool) $discussion->is_tag_sticky;
        })
        ->attribute('canStickiest', function (DiscussionSerializer $serializer, $discussion) {
            return (bool) $serializer->getActor()->can('stickiest', $discussion);
        })
        ->attribute('canTagSticky', function (DiscussionSerializer $serializer, $discussion) {
            return (bool) $serializer->getActor()->can('stickiest.tagSticky', $discussion);
        }),

    (new Extend\ApiController(FlarumController\ListDiscussionsController::class))
        ->addInclude('stickyTags'),

    (new Extend\ApiController(FlarumController\ShowDiscussionController::class))
        ->addInclude('stickyTags'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\Event())
        ->listen(Saving::class, Listener\SaveStickyToDatabase::class)
        ->listen(DiscussionWasTagged::class, Listener\DeleteTagStickyWhenTagsAreChanged::class)
        ->listen(DiscussionWasSuperStickied::class, [Listener\CreatePostWhenDiscussionIsSuperStickied::class, 'whenDiscussionWasSuperStickied'])
        ->listen(DiscussionWasUnSuperStickied::class, [Listener\CreatePostWhenDiscussionIsSuperStickied::class, 'whenDiscussionWasUnSuperStickied']),

    (new Extend\Filter(DiscussionFilterer::class))
        ->addFilter(StickiestFilterGambit::class)
        ->addFilter(TagStickyFilterGambit::class),

    (new Extend\ServiceProvider())
        ->register(PinProvider::class),

    (new Extend\Settings())
        ->default('the-turk-stickiest.badge_icon', 'fas fa-layer-group')
        ->default('the-turk-stickiest.display_tag_sticky', '1')
        ->serializeToForum('stickiest.badge_icon', 'the-turk-stickiest.badge_icon'),

    (new Extend\SimpleFlarumSearch(DiscussionSearcher::class))
        ->addGambit(StickiestFilterGambit::class)
        ->addGambit(TagStickyFilterGambit::class),
];
