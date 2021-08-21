<?php

/*
 * This file is part of fof/forum-statistics-widget.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\ForumStatisticsWidget;

use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Discussion\Discussion;
use Flarum\Extend;
use Flarum\Post\Post;
use Flarum\User\User;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    new Extend\Locales(__DIR__.'/resources/locale'),

    (new Extend\Settings())
        ->serializeToForum(
            'fof-forum-statistics-widget.ignore_private_discussions',
            'fof-forum-statistics-widget.ignore_private_discussions',
            'boolval'
        )
        ->serializeToForum(
            'fof-forum-statistics-widget.widget_order',
            'fof-forum-statistics-widget.widget_order',
            'intval',
            0
        ),

    (new Extend\ApiSerializer(ForumSerializer::class))
    ->attributes(function ($serializer, $model, $attributes) {
        if ($serializer->getActor()->can('fof-forum-statistics-widget.viewWidget.discussionsCount')) {
            $attributes['fof-forum-statistics-widget.discussionsCount'] = $attributes['fof-forum-statistics-widget.ignore_private_discussions'] ?
            Discussion::where('is_private', 0)->count() : Discussion::count();
        }

        if ($serializer->getActor()->can('fof-forum-statistics-widget.viewWidget.postsCount')) {
            $attributes['fof-forum-statistics-widget.postsCount'] = Post::where('type', 'comment')->count();
        }
        if ($serializer->getActor()->can('fof-forum-statistics-widget.viewWidget.usersCount')) {
            $attributes['fof-forum-statistics-widget.usersCount'] = User::count();
        }
        if ($serializer->getActor()->can('fof-forum-statistics-widget.viewWidget.latestMember')) {
            $lastUser = User::orderBy('joined_at', 'DESC')->limit(1)->first();

            $attributes['fof-forum-statistics-widget.lastUserId'] = $lastUser != null ? $lastUser->id : null;
        }

        return $attributes;
    }),
];
