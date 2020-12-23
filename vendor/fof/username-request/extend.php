<?php

/*
 * This file is part of fof/username-request.
 *
 * Copyright (c) 2019 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace FoF\UserRequest;

use Flarum\Api\Controller\ListUsersController;
use Flarum\Api\Controller\ShowForumController;
use Flarum\Api\Controller\ShowUserController;
use Flarum\Api\Serializer;
use Flarum\Extend;
use Flarum\User\User;
use FoF\UserRequest\Api\Controller;
use FoF\UserRequest\Api\Serializer\RequestSerializer;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->route('/u/{username}/history', 'username.history.view')
        ->route('/username-requests', 'username.request.view'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    (new Extend\Routes('api'))
        ->get('/username-requests', 'username.request.index', Controller\ListRequestsController::class)
        ->post('/username-requests', 'username.request.create', Controller\CreateRequestController::class)
        ->patch('/username-requests/{id}', 'username.request.act', Controller\ActOnRequestController::class)
        ->delete('/username-requests/{id}', 'username.request.delete', Controller\DeleteRequestController::class),

    (new Extend\Model(User::class))
        ->hasOne('username_requests', UsernameRequest::class, 'user_id'),

    new Extend\Locales(__DIR__.'/resources/locale'),

    (new Extend\ApiSerializer(Serializer\UserSerializer::class))
        ->attribute('usernameHistory', function (Serializer\UserSerializer $serializer, User $user) {
            return json_decode($user->username_history);
        })
        ->hasOne('username_requests', RequestSerializer::class),

    (new Extend\ApiSerializer(Serializer\ForumSerializer::class))
        ->attribute('canRequestUsername', function (Serializer\ForumSerializer $serializer) {
            return $serializer->getActor()->hasPermissionLike('user.requestUsername');
        })
        ->hasMany('username_requests', RequestSerializer::class),

    (new Extend\ApiController(ShowForumController::class))
        ->addInclude(['username_requests', 'username_requests.user'])
        ->prepareDataForSerialization(AddUsernameRequests::class),

    (new Extend\ApiController(ListUsersController::class))
        ->addInclude('username_requests'),

    (new Extend\ApiController(ShowUserController::class))
        ->addInclude('username_requests'),
];
