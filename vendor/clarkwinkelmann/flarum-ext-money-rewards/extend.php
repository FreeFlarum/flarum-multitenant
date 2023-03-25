<?php

namespace ClarkWinkelmann\MoneyRewards;

use Flarum\Api\Controller\ListPostsController;
use Flarum\Api\Controller\ShowDiscussionController;
use Flarum\Api\Serializer\BasicPostSerializer;
use Flarum\Api\Serializer\BasicUserSerializer;
use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Extend;
use Flarum\Post\Post;
use Flarum\User\User;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/less/forum.less'),

    (new Extend\Routes('api'))
        ->post('/posts/{id}/money-rewards', 'money-rewards.create', Controllers\CreateRewardController::class)
        ->get('/users/{id}/money-rewards', 'money-rewards.history', Controllers\ListUserRewardController::class),

    new Extend\Locales(__DIR__ . '/locale'),

    (new Extend\ApiSerializer(ForumSerializer::class))
        ->attributes(ForumAttributes::class),

    (new Extend\ApiSerializer(BasicPostSerializer::class))
        ->attributes(PostAttributes::class),

    (new Extend\ApiSerializer(BasicUserSerializer::class))
        ->attributes(UserAttributes::class),

    (new Extend\Policy())
        ->modelPolicy(Post::class, Policies\PostPolicy::class)
        ->modelPolicy(User::class, Policies\UserPolicy::class),

    (new Extend\Model(Post::class))
        ->hasMany('moneyRewards', Reward::class, 'post_id'),

    (new Extend\ApiSerializer(BasicPostSerializer::class))
        ->hasMany('moneyRewards', RewardSerializer::class),

    (new Extend\ApiController(ListPostsController::class))
        ->addInclude('moneyRewards.giver'),

    (new Extend\ApiController(ShowDiscussionController::class))
        ->addInclude('posts.moneyRewards.giver'),
];
