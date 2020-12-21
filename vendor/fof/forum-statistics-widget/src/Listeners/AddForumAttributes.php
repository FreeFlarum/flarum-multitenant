<?php

/*
 * This file is part of fof/forum-statistics-widget.
 *
 * Copyright (c) 2020 FriendsOfFlarum.
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

class AddForumAttributes
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
     * @param Serializing $serializer
     */
    public function __invoke(ForumSerializer $serializer)
    {
        $lastUser = User::orderBy('joined_at', 'DESC')->limit(1)->first();
        $attributes['discussionsCount'] = $this->settings->get('fof-forum-statistics-widget.ignore_private_discussions') ? Discussion::where('is_private', 0)->count() : Discussion::count();
        $attributes['postsCount'] = Post::where('type', 'comment')->count();
        $attributes['usersCount'] = User::count();
        $attributes['lastUser'] = $lastUser != null ? $lastUser->display_name : null;
        $attributes['fof-forum-statistics-widget.widget_order'] = (int) $this->settings->get('fof-forum-statistics-widget.widget_order', 0);
        $attributes['fof-forum-statistics-widget.ignore_private_discussions'] = (bool) $this->settings->get('fof-forum-statistics-widget.ignore_private_discussions', true);

        return $attributes;
    }
}
