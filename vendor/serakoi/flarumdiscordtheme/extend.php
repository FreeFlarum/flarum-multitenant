<?php

/*
 * This file is part of serakoi/flarumdiscordtheme.
 *
 * Copyright (c) 2021 Serakoi.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Serakoi\FlarumDiscordTheme;

use Flarum\Extend;
use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Api\Event\Serializing;


return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),
    new Extend\Locales(__DIR__.'/resources/locale'),
    (new Extend\Settings)
        ->serializeToForum('authorBadge', 'serakoi-flarumdiscordtheme.authorBadge'),
];
