<?php

namespace Nearata\NoSelfLikes;

use Flarum\Post\Post;
use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class PostPolicy extends AbstractPolicy
{
    protected function like(User $user, Post $post)
    {
        if ($user->id === $post->user_id) {
            return $this->deny();
        }
    }
}
