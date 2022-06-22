<?php

/*
 * This file is part of afrux/online-users-widget.
 *
 * Copyright (c) 2021 Sami Mazouz.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Afrux\OnlineUsers;

use Flarum\Api\Serializer as FlarumSerializer;
use Flarum\Api\Controller\ShowForumController;
use Flarum\Extend;
use Flarum\User\Filter\UserFilterer;
use Flarum\User\Search\UserSearcher;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less'),

    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\ApiSerializer(FlarumSerializer\ForumSerializer::class))
        ->attribute('canViewLastSeenAt', function ($serializer) {
            return $serializer->getActor()->hasPermission('user.viewLastSeenAt');
        })
        ->hasMany('onlineUsers', FlarumSerializer\UserSerializer::class),

    (new Extend\ApiController(ShowForumController::class))
        ->addInclude(['onlineUsers'])
        ->prepareDataForSerialization(LoadForumOnlineUsersRelationship::class),

    (new Extend\Settings)
        ->serializeToForum('afrux-online-users-widget.maxUsers', 'afrux-online-users-widget.max_users', 'intval'),

    (new Extend\Filter(UserFilterer::class))
        ->addFilter(Query\OnlineGambitFilter::class),

    (new Extend\SimpleFlarumSearch(UserSearcher::class))
        ->addGambit(Query\OnlineGambitFilter::class),
];
