<?php

namespace ClarkWinkelmann\LikesReceived\Listeners;

use Flarum\Likes\Event\PostWasLiked;
use Flarum\Likes\Event\PostWasUnliked;
use Flarum\Post\Post;

class UpdateLikesCount
{
    protected function postCounts(Post $post)
    {
        return $post->user && $post->type === 'comment' && !$post->is_private;
    }

    public function postWasLiked(PostWasLiked $event)
    {
        if (!$this->postCounts($event->post)) {
            return;
        }

        $event->post->user->clarkwinkelmann_likes_received_count++;
        $event->post->user->save();
    }

    public function postWasUnliked(PostWasUnliked $event)
    {
        if (!$this->postCounts($event->post)) {
            return;
        }

        // Substract one like but don't go below zero
        $event->post->user->clarkwinkelmann_likes_received_count = max($event->post->user->clarkwinkelmann_likes_received_count - 1, 0);
        $event->post->user->save();
    }
}
