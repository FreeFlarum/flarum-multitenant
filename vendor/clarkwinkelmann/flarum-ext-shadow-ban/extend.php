<?php

namespace ClarkWinkelmann\ShadowBan;

use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Api\Serializer\PostSerializer;
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Discussion\Discussion;
use Flarum\Discussion\Event\Saving as DiscussionSaving;
use Flarum\Extend;
use Flarum\Post\Event\Saving as PostSaving;
use Flarum\Post\Post;
use Flarum\User\Event\Saving as UserSaving;
use Flarum\User\User;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/resources/less/forum.less'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\Model(User::class))
        ->dateAttribute('shadow_banned_until'),

    (new Extend\Event())
        ->listen(DiscussionSaving::class, Listener\SaveDiscussion::class)
        ->listen(PostSaving::class, Listener\SavePost::class)
        ->listen(UserSaving::class, Listener\SaveUser::class),

    (new Extend\Policy())
        ->modelPolicy(Discussion::class, Policy\DiscussionPolicy::class)
        ->modelPolicy(Post::class, Policy\PostPolicy::class)
        ->modelPolicy(User::class, Policy\UserPolicy::class),

    (new Extend\ModelVisibility(Discussion::class))
        ->scope(Scope\ViewDiscussion::class),
    (new Extend\ModelVisibility(Post::class))
        ->scope(Scope\ViewPost::class),
    (new Extend\ModelVisibility(User::class))
        ->scope(Scope\ViewUser::class),

    (new Extend\ApiSerializer(DiscussionSerializer::class))
        ->attributes(DiscussionAttributes::class),
    (new Extend\ApiSerializer(PostSerializer::class))
        ->attributes(PostAttributes::class),
    (new Extend\ApiSerializer(UserSerializer::class))
        ->attributes(UserAttributes::class),
];
