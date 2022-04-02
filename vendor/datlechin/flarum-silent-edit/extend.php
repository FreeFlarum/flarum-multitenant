<?php

/*
 * This file is part of datlechin/flarum-silent-edit.
 *
 * Copyright (c) 2022 Ngo Quoc Dat.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Datlechin\SilentEdit;

use Datlechin\SilentEdit\Listeners\ClearLastEdit;
use Flarum\Api\Serializer\PostSerializer;
use Flarum\Extend;
use Flarum\Post\Event\Saving;
use Flarum\Post\Post;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    new Extend\Locales(__DIR__ . '/locale'),

    (new Extend\ApiSerializer(PostSerializer::class))
        ->attribute('canClearLastEdit', function (PostSerializer $serializer, Post $post, array $attributes) {
            return $serializer->getActor()->can('canClearLastEdit', $post);
        }),

    (new Extend\Event())
        ->listen(Saving::class, ClearLastEdit::class),
];
