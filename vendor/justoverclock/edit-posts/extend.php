<?php

/*
 * This file is part of justoverclock/edit-posts.
 *
 * Copyright (c) 2021 Marco Colia.
 * https://flarum.it
 * based on Clark Winkelmann tutorial
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Justoverclock\EditPostsButton;

use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),
    new Extend\Locales(__DIR__ . '/resources/locale'),
];
