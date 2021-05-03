<?php

namespace ClarkWinkelmann\AuthorChange;

use Flarum\Api\Controller;
use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Discussion\Event\Saving as DiscussionSaving;
use Flarum\Extend;
use Flarum\Post\Event\Saving as PostSaving;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/resources/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\ApiController(Controller\ShowDiscussionController::class))
        ->addInclude('user'),
    (new Extend\ApiController(Controller\CreateDiscussionController::class))
        ->addInclude('user'),
    (new Extend\ApiController(Controller\UpdateDiscussionController::class))
        ->addInclude('user'),

    (new Extend\Event())
        ->listen(DiscussionSaving::class, Listeners\SaveDiscussion::class)
        ->listen(PostSaving::class, Listeners\SavePost::class),

    (new Extend\ApiSerializer(ForumSerializer::class))
        ->attributes(ForumAttributes::class),
];
