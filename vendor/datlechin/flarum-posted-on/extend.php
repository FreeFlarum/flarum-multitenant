<?php

/*
 * This file is part of datlechin/flarum-posted-on.
 *
 * Copyright (c) 2022 Ngo Quoc Dat.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Datlechin\PostedOn;

use Datlechin\PostedOn\Listeners\SaveDisclosePostedOnToUser;
use Datlechin\PostedOn\Listeners\SavePostedOnToPost;
use Flarum\Api\Serializer\PostSerializer;
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Extend;
use Flarum\Post\Event\Saving as PostSaving;
use Flarum\Post\Post;
use Flarum\User\Event\Saving as UserSaving;
use Flarum\User\User;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js'),

    new Extend\Locales(__DIR__ . '/locale'),

    (new Extend\Event())
        ->listen(PostSaving::class, SavePostedOnToPost::class)
        ->listen(UserSaving::class, SaveDisclosePostedOnToUser::class),

    (new Extend\ApiSerializer(PostSerializer::class))
        ->attributes(function (PostSerializer $serializer, Post $post, array $attributes) {
            $attributes['posted_on'] = $post->posted_on;
            return $attributes;
        }),

    (new Extend\ApiSerializer(UserSerializer::class))
        ->attributes(function (UserSerializer $serializer, User $user, array $attributes) {
            $attributes['disclosePostedOn'] = (bool) $user->disclose_posted_on;

            return $attributes;
        }),
];
