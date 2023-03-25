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
use Malago\Achievements\Achievement;
use Malago\Achievements\AchievementUser;
use Malago\Achievements\Api\Serializers\AchievementSerializer;
use Malago\Achievements\Middlewares\MiddlewarePosted;

return [
    (new Extend\Frontend('forum'))
        ->route('/achievements', 'malago-achievements'),
        
    (new Extend\Routes('api'))
        ->get('/achievements', 'achievements.index', Controllers\ListAchievementsController::class)
        ->post('/achievements', 'achievements.create', Controllers\CreateAchievementController::class)
        ->patch('/achievements/{id}', 'achievements.update', Controllers\UpdateAchievementController::class)
        ->delete('/achievements/{id}', 'achievements.delete', Controllers\DeleteAchievementController::class)
        ->post('/achievement_user', 'achievements_user.create', Controllers\CreateAchievementUserController::class)
        ->patch('/achievement_user/{id}', 'achievements_user.update', Controllers\UpdateAchievementUserController::class),
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less'),
    new Extend\Locales(__DIR__.'/locale'),
    (new Extend\Model(User::class))
        ->relationship('achievements', function ($user) {
            return $user->hasMany(AchievementUser::class, 'user_id');
        }),
    (new Extend\ApiSerializer(Serializer\ForumSerializer::class))
        ->hasMany('achievements', Serializers\AchievementSerializer::class),

    (new Extend\ApiSerializer(Serializer\UserSerializer::class))
        ->hasMany('achievements', Serializers\AchievementUserSerializer::class),

    (new Extend\ApiSerializer(Serializer\BasicUserSerializer::class))
        ->hasMany('achievements', Serializers\AchievementSerializer::class)
        ->attributes(AddUserData::class),

    (new Extend\ApiController(Controller\ListUsersController::class))
        ->addInclude('achievements'),
    (new Extend\ApiController(Controller\ShowUserController::class))
        ->addInclude('achievements'),
    (new Extend\ApiController(Controller\UpdateUserController::class))
        ->addInclude('achievements'),
    (new Extend\ApiController(Controller\CreateUserController::class))
        ->addInclude('achievements'),
    (new Extend\ApiController(Controller\ShowDiscussionController::class))
        ->addInclude('posts.user.achievements'),
    (new Extend\ApiController(Controller\ListPostsController::class))
        ->addInclude('user.achievements'),

    (new Extend\ApiSerializer(Serializer\PostSerializer::class))
        ->attributes(AddPostData::class),


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

    (new Extend\Settings)
        ->serializeToForum('malago-achievements.show-post-footer', 'malago-achievements.show-post-footer')
        ->serializeToForum('malago-achievements.show-user-card', 'malago-achievements.show-user-card')
        ->serializeToForum('malago-achievements.link-left-column', 'malago-achievements.link-left-column')
];
