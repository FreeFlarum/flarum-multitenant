<?php

namespace ClarkWinkelmann\ShadowBan\Event;

use Flarum\Post\Post;
use Flarum\User\User;

/**
 * Dispatched when a post is shadow-hidden manually or automatically.
 *
 * @property Post $post
 * @property User|null $actor Actor if manually hidden, or null if hidden automatically because of a user ban
 */
class ShadowHiddenPost
{
    public $post;
    public $actor;

    public function __construct(Post $post, User $actor = null)
    {
        $this->post = $post;
        $this->actor = $actor;
    }
}
