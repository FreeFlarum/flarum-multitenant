<?php

/*
 * This file is part of fof/forum-statistics-widget.
 *
 * Copyright (c) 2019 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace FoF\ForumStatisticsWidget\Listeners;

use Flarum\Api\Event\Serializing;
use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Discussion\Discussion;
use Flarum\Post\Post;
use Flarum\User\User;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;

class AddRelationships
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * AddRelationships constructor.
     * @param SettingsRepositoryInterface $settings
     */
    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(Serializing::class, [$this, 'prepareApiAttributes']);
    }

    /**
     * @param Serializing $event
     */
    public function prepareApiAttributes(Serializing $event)
    {
        if ($event->isSerializer(ForumSerializer::class)) {
            $lastUser = User::orderBy('joined_at', 'DESC')->limit(1)->first();
            $event->attributes['discussionsCount'] = Discussion::count();
            $event->attributes['postsCount'] = Post::count();
            $event->attributes['usersCount'] = User::count();
            $event->attributes['lastUser'] = $lastUser != null ? $lastUser->username : null;
            $event->attributes['fof-forum-statistics-widget.widget_order'] = $this->settings->get('fof-forum-statistics-widget.widget_order');
        }
    }
}

