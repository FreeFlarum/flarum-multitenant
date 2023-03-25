<?php

namespace ClarkWinkelmann\MoneyRewards\Policies;

use Flarum\Post\CommentPost;
use Flarum\Post\Post;
use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class PostPolicy extends AbstractPolicy
{
    public function rewardWithMoney(User $actor, Post $post)
    {
        return ($post instanceof CommentPost) && // Only text posts
            $post->user_id && // Cannot reward anonymous posts or by deleted users
            $post->user_id !== $actor->id && // Cannot reward yourself
            $actor->can('rewardPostsWithMoney', $post->discussion);
    }
}
