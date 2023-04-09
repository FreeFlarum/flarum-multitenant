<?php

/*
 * This file is part of datlechin/flarum-more-discussions.
 *
 * Copyright (c) 2022 Ngo Quoc Dat.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Datlechin\MoreDiscussions;

use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    new Extend\Locales(__DIR__ . '/locale'),

    (new Extend\Settings())
        ->serializeToForum('datlechin-more-discussions.blockName', 'datlechin-more-discussions.block_name', 'strval')
        ->serializeToForum('datlechin-more-discussions.discussionLimit', 'datlechin-more-discussions.discussion_limit', 'intval')
        ->serializeToForum('datlechin-more-discussions.filterBy', 'datlechin-more-discussions.filter_by', 'strval'),

];
