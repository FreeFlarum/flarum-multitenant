<?php

namespace ClarkWinkelmann\LikesReceived;

use Flarum\Api\Serializer\UserSerializer;
use Flarum\Extend;
use Flarum\Likes\Event\PostWasLiked;
use Flarum\Likes\Event\PostWasUnliked;
use Flarum\User\User;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\Console())
        ->command(Commands\UpdateLikesReceivedCommand::class),

    (new Extend\Policy)
        ->modelPolicy(User::class, Access\UserPolicy::class),

    (new Extend\ApiSerializer(UserSerializer::class))
        ->attributes(Listeners\UserAttributes::class),

    (new Extend\Event)
        ->listen(PostWasLiked::class, [Listeners\UpdateLikesCount::class, 'postWasLiked'])
        ->listen(PostWasUnliked::class, [Listeners\UpdateLikesCount::class, 'postWasUnliked'])
];
