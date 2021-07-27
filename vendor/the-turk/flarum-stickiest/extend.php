<?php

/*
 * This file is part of Stickiest.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

use Flarum\Api\Controller\ListDiscussionsController;
use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Discussion\Event\Saving;
use Flarum\Discussion\Filter\DiscussionFilterer;
use Flarum\Discussion\Search\DiscussionSearcher;
use Flarum\Extend;
use TheTurk\Stickiest\Event\DiscussionWasSuperStickied;
use TheTurk\Stickiest\Event\DiscussionWasUnSuperStickied;
use TheTurk\Stickiest\Listener\SaveStickiestToDatabase;
use TheTurk\Stickiest\Listener\SaveTagStickyToDatabase;
use TheTurk\Stickiest\Post\DiscussionSuperStickiedPost;
use TheTurk\Stickiest\Query\StickiestFilterGambit;
use TheTurk\Stickiest\Query\TagStickyFilterGambit;
use TheTurk\Stickiest\Listener;
use TheTurk\Stickiest\Provider;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),
    
    (new Extend\Post())
        ->type(DiscussionSuperStickiedPost::class),

    (new Extend\ApiSerializer(DiscussionSerializer::class))
        ->attribute('isStickiest', function (DiscussionSerializer $serializer, $discussion) {
            return (bool) $discussion->is_stickiest;
        })
        ->attribute('isTagSticky', function (DiscussionSerializer $serializer, $discussion) {
            return (bool) $discussion->is_tagSticky;
        })
        ->attribute('canStickiest', function (DiscussionSerializer $serializer, $discussion) {
            return (bool) $serializer->getActor()->can('stickiest', $discussion);
        })
        ->attribute('canTagSticky', function (DiscussionSerializer $serializer, $discussion) {
            return (bool) $serializer->getActor()->can('stickiest.tagSticky', $discussion);
        }),

    (new Extend\ApiController(ListDiscussionsController::class))
        ->addInclude('firstPost'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\Event())
        ->listen(Saving::class, SaveStickiestToDatabase::class)
        ->listen(Saving::class, SaveTagStickyToDatabase::class)
        ->listen(DiscussionWasSuperStickied::class, [Listener\CreatePostWhenDiscussionIsSuperStickied::class, 'whenDiscussionWasSuperStickied'])
        ->listen(DiscussionWasUnSuperStickied::class, [Listener\CreatePostWhenDiscussionIsSuperStickied::class, 'whenDiscussionWasUnSuperStickied']),

    (new Extend\Filter(DiscussionFilterer::class))
        ->addFilter(StickiestFilterGambit::class)
        ->addFilter(TagStickyFilterGambit::class),
    
    (new Extend\ServiceProvider())
        ->register(Provider\PinProvider::class),
    
    (new Extend\Settings())
        ->serializeToForum('stickiest.badge_icon', 'the-turk-stickiest.badge_icon'),

    (new Extend\SimpleFlarumSearch(DiscussionSearcher::class))
        ->addGambit(StickiestFilterGambit::class)
        ->addGambit(TagStickyFilterGambit::class),
];
