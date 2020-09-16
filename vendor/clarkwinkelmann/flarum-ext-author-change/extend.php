<?php

namespace ClarkWinkelmann\AuthorChange;

use ClarkWinkelmann\AuthorChange\Extenders\DiscussionIncludes;
use ClarkWinkelmann\AuthorChange\Extenders\ForumAttributes;
use ClarkWinkelmann\AuthorChange\Extenders\SaveAuthor;
use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/resources/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    new DiscussionIncludes(),
    new ForumAttributes(),
    new SaveAuthor(),
];
