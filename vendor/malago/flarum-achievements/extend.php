<?php
/*
 * This file is part of malago/achievements
 *
 *  Copyright (c) 2021 Miguel A. Lago
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Malago\Achievements;

use Flarum\Extend;
use Illuminate\Contracts\Events\Dispatcher;
use Flarum\User\User;
use Flarum\User\Event\LoggedIn;
use Flarum\User\Event\AvatarChanged;

use Flarum\Post\Event\Posted;
use Flarum\Post\Event\Revised;
use Flarum\Discussion\Event\Started;

use Flarum\Api\Controller;
use Flarum\Api\Serializer;

use Flarum\Likes\Event\PostWasLiked;
use Flarum\Likes\Event\PostWasUnliked;

use Malago\Achievements\Api\Serializers;
use Malago\Achievements\Api\Controllers;
use Malago\Achievements\Api\Serializers\AchievementSerializer;
use Malago\Achievements\Middlewares\MiddlewarePosted;

return [
    (new Extend\Routes('api'))
        ->get('/achievements', 'achievements.index', Controllers\ListAchievementsController::class)
        ->post('/achievements', 'achievements.create', Controllers\CreateAchievementController::class)
        ->patch('/achievements/{id}', 'achievements.update', Controllers\UpdateAchievementController::class)
        ->delete('/achievements/{id}', 'achievements.delete', Controllers\DeleteAchievementController::class)
        ->post('/achievement_user', 'achievements_user.create', Controllers\CreateAchievementUserController::class),
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less'),
    new Extend\Locales(__DIR__.'/locale'),
    (new Extend\Model(User::class))
        ->relationship('achievements', function ($ach) {
            return $ach->belongsToMany(Achievement::class, 'achievement_user')
                ->withPivot("new")
                ->withTimestamps();
        }),

    (new Extend\ApiSerializer(Serializer\ForumSerializer::class))
        ->hasMany('achievements', Serializers\AchievementSerializer::class),

    (new Extend\ApiSerializer(Serializer\UserSerializer::class))
        ->hasMany('achievements', Serializers\AchievementSerializer::class),

    (new Extend\ApiController(Controller\ListUsersController::class))
        ->addInclude('achievements'),
    (new Extend\ApiController(Controller\ShowUserController::class))
        ->addInclude('achievements'),
    (new Extend\ApiSerializer(Serializer\PostSerializer::class))
        ->mutate(AddPostData::class),

    (new Extend\Event())
        ->listen(LoggedIn::class, Listeners\UpdateAchievementsOnLogin::class),

    (new Extend\Event())
        ->listen(Posted::class, Listeners\UpdateAchievementsOnPost::class)
        ->listen(Revised::class, Listeners\UpdateAchievementsOnRevised::class)
        ->listen(Started::class, Listeners\UpdateAchievementsOnDiscussion::class)
        ->listen(PostWasLiked::class, Listeners\UpdateAchievementsOnLike::class)
        ->listen(PostWasUnliked::class, Listeners\UpdateAchievementsOnUnlike::class)
        ->listen(AvatarChanged::class, Listeners\UpdateAchievementsOnAvatarChanged::class),
    
    (new Extend\Middleware('api'))->add(MiddlewarePosted::class),
    (new Extend\Middleware('forum'))->add(MiddlewarePosted::class),
];
