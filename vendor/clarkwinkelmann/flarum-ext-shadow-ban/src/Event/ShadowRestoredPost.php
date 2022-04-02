<?php

namespace ClarkWinkelmann\ShadowBan\Event;

use Flarum\Post\Post;
use Flarum\User\User;

/**
 * When a post is manually restored from shadow-hide.
 *
 * @property Post $post
 * @property User $actor
 */
class ShadowRestoredPost
{
    public $post;
    public $actor;

    public function __construct(Post $post, User $actor)
    {
        $this->post = $post;
        $this->actor = $actor;
    }
}
