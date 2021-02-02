<?php

namespace ClarkWinkelmann\AuthorChange;

use Flarum\Api\Controller;
use Flarum\Extend;

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

    new Extenders\ForumAttributes(),
    new Extenders\SaveAuthor(),
];
