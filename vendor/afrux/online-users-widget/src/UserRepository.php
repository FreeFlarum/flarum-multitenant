<?php

/*
 * This file is part of afrux/top-posters-widget.
 *
 * Copyright (c) 2021 Sami Mazouz.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Afrux\OnlineUsers;

use Afrux\ForumWidgets\SafeCacheRepositoryAdapter;
use Carbon\Carbon;
use Flarum\User\User;
use Flarum\Settings\SettingsRepositoryInterface;

class UserRepository
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @var SafeCacheRepositoryAdapter
     */
    protected $cache;

    public function __construct(SettingsRepositoryInterface $settings, SafeCacheRepositoryAdapter $cache)
    {
        $this->settings = $settings;
        $this->cache = $cache;
    }

    public function getLastSeenUsers(User $actor): array
    {
        $time = Carbon::now()->subMinutes(5);
        $limit = $this->settings->get('afrux-online-users-widget.max_users', 15);

        return $this->cache->remember('afrux-online-users-widget.users', 40, function () use ($actor, $time, $limit) {
            return User::query()
                ->select('id', 'preferences')
                ->whereVisibleTo($actor)
                ->where('last_seen_at', '>', $time)
                ->limit($limit + 1)
                ->get()
                ->filter(function ($user) {
                    return (bool)$user->getPreference('discloseOnline');
                })
                ->pluck('id')
                ->toArray();
        }) ?: [];
    }

    public function getOnlineUsers(User $actor)
    {
        return User::whereIn('id', $this->getLastSeenUsers($actor))->get();
    }
}
