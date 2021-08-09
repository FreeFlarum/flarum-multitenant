<?php

/*
 * This file is part of afrux/top-posters-widget.
 *
 * Copyright (c) 2021 Sami Mazouz.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Afrux\TopPosters;

use Carbon\Carbon;
use Flarum\Post\CommentPost;
use Illuminate\Contracts\Cache\Factory;
use function Afrux\ForumWidgets\Helper\pretty_number_format;

class UserRepository
{
    /**
     * @var Factory
     */
    private $cache;

    public function __construct(Factory $cache)
    {
        $this->cache = $cache;
    }

    public function getTopPosters(): array
    {
        return $this->cache->remember('afrux-top-posters-widget.data', 600, function (): array {
            return CommentPost::query()
                ->selectRaw('user_id, count(id) as count')
                ->where('created_at', '>', Carbon::now()->subMonth())
                ->groupBy('user_id')
                ->orderBy('count', 'desc')
                ->limit(5)
                ->get()
                ->mapWithKeys(function ($post) {
                    return [$post->user_id => pretty_number_format((int) $post->count)];
                })
                ->toArray();
        });
    }
}
