<?php

/*
 * This file is part of askvortsov/flarum-moderator-warnings
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Askvortsov\FlarumWarnings;

use Askvortsov\FlarumWarnings\Access\UserPolicy;
use Askvortsov\FlarumWarnings\Api\Controller;
use Askvortsov\FlarumWarnings\Api\Serializer\WarningSerializer;
use Askvortsov\FlarumWarnings\Model\Warning;
use Askvortsov\FlarumWarnings\Notification\WarningBlueprint;
use Askvortsov\FlarumWarnings\Provider\WarningProvider;
use Flarum\Api\Controller as FlarumController;
use Flarum\Api\Serializer as FlarumSerializer;
use Flarum\Extend;
use Flarum\Post\Post;
use Flarum\User\User;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),

    new Extend\Locales(__DIR__.'/resources/locale'),

    (new Extend\Routes('api'))
        ->get('/warnings/{user_id}', 'warnings.index', Controller\ListWarningsController::class)
        ->patch('/warnings/{warning_id}', 'warnings.update', Controller\UpdateWarningController::class)
        ->delete('/warnings/{warning_id}', 'warnings.delete', Controller\DeleteWarningController::class)
        ->post('/warnings', 'warnings.create', Controller\CreateWarningController::class),

    (new Extend\Model(Post::class))
        ->hasMany('warnings', Warning::class, 'post_id'),

    (new Extend\View())
        ->namespace('askvortsov-moderator-warnings', __DIR__.'/views'),

    (new Extend\Notification())
        ->type(WarningBlueprint::class, WarningSerializer::class, ['alert', 'email']),

    (new Extend\ApiSerializer(FlarumSerializer\UserSerializer::class))
        ->attribute('canViewWarnings', function ($serializer, $model) {
            return $model->can('user.viewWarnings');
        })
        ->attribute('canManageWarnings', function ($serializer, $model) {
            return $model->can('user.manageWarnings');
        })
        ->attribute('canDeleteWarnings', function ($serializer, $model) {
            return $model->can('user.deleteWarnings');
        })
        ->attribute('visibleWarningCount', function ($serializer, $model) {
            return Warning::where('user_id', $model->id)->where('hidden_at', null)->count();
        }),

    (new Extend\ApiSerializer(FlarumSerializer\BasicPostSerializer::class))
        ->relationship('warnings', function ($serializer, $model) {
            $actor = $serializer->getActor();
            $author = $model->user;
            if ($author && $actor->id === $author->id || $actor->can('user.viewWarnings', $author)) {
                return $serializer->hasMany($model, WarningSerializer::class, 'warnings');
            }
        }),

    (new Extend\ApiController(FlarumController\ShowDiscussionController::class))
        ->addInclude([
            'posts.warnings',
            'posts.warnings.warnedUser',
            'posts.warnings.addedByUser',
        ]),

    (new Extend\ApiController(FlarumController\ListPostsController::class))
        ->addInclude([
            'warnings',
            'warnings.warnedUser',
            'warnings.addedByUser',
        ]),

    (new Extend\Policy())
        ->modelPolicy(User::class, UserPolicy::class),

    (new Extend\ServiceProvider())
        ->register(WarningProvider::class),
];
