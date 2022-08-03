<?php

/*
 * This file is part of fof/filter.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\Filter\Listener;

use Flarum\Post\CommentPost;
use Flarum\Post\Event\Posted;
use Flarum\Post\PostRepository;
use Flarum\Settings\SettingsRepositoryInterface;

class AutoMerge
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @var PostRepository
     */
    protected $posts;

    /**
     * @param SettingsRepositoryInterface $settings
     * @param PostRepository              $posts
     */
    public function __construct(SettingsRepositoryInterface $settings, PostRepository $posts)
    {
        $this->settings = $settings;
        $this->posts = $posts;
    }

    public function handle(Posted $event)
    {
        $post = $event->post;

        if ($post instanceof CommentPost && $post->number !== 1 && !$post->auto_mod && (bool) $this->settings->get('fof-filter.autoMergePosts')) {
            $oldPost = $this->posts->query()
                ->where('discussion_id', '=', $post->discussion_id)
                ->where('number', '<', $post->number)
                ->where('hidden_at', '=', null)
                ->orderBy('number', 'desc')
                ->firstOrFail();

            if (!$oldPost instanceof CommentPost) {
                return;
            }

            $cooldown = $this->settings->get('fof-filter.cooldown');

            if ($oldPost->user_id == $post->user_id && strtotime("-$cooldown minutes") < strtotime($oldPost->created_at)) {
                $oldPost->revise($oldPost->content."\n\n".$post->content, $post->user);

                $oldPost->save();

                $post->delete();
            }
        }
    }
}
