<?php

/*
 * This file is part of fof/username-request.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
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
        ->hasMany('nameChangeRequests', UsernameRequest::class, 'user_id')
        ->relationship('lastNicknameRequest', function ($user) {
            return $user->hasOne(UsernameRequest::class, 'user_id', null)->where('for_nickname', true);
        })
        ->relationship('lastUsernameRequest', function ($user) {
            return $user->hasOne(UsernameRequest::class, 'user_id', null)->where('for_nickname', false);
        }),

    new Extend\Locales(__DIR__.'/resources/locale'),

    (new Extend\ApiSerializer(Serializer\UserSerializer::class))
        ->attribute('usernameHistory', function (Serializer\UserSerializer $serializer, User $user) {
            return json_decode($user->username_history);
        })
        ->hasOne('lastNicknameRequest', RequestSerializer::class)
        ->hasOne('lastUsernameRequest', RequestSerializer::class),

    (new Extend\ApiSerializer(Serializer\ForumSerializer::class))
        ->attribute('canRequestUsername', function (Serializer\ForumSerializer $serializer) {
            return $serializer->getActor()->hasPermission('user.requestUsername');
        })
        ->attribute('canRequestNickname', function (Serializer\ForumSerializer $serializer) {
            return $serializer->getActor()->hasPermission('user.requestNickname');
        })
        ->hasMany('username_requests', RequestSerializer::class),

    (new Extend\ApiController(ShowForumController::class))
        ->addInclude(['username_requests', 'username_requests.user'])
        ->prepareDataForSerialization(AddUsernameRequests::class),

    (new Extend\ApiController(ListUsersController::class))
        ->addInclude(['lastNicknameRequest', 'lastUsernameRequest']),

    (new Extend\ApiController(ShowUserController::class))
        ->addInclude(['lastNicknameRequest', 'lastUsernameRequest']),
];
