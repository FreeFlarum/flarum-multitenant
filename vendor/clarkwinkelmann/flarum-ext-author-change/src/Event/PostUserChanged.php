<?php

namespace ClarkWinkelmann\AuthorChange\Event;

use Flarum\Post\Post;
use Flarum\User\User;

/**
 * The author of a post was modified.
 * @property Post $post
 * @property User|null $oldUser Previous post author if any
 * @property User|null $actor Actor who performed the change
 */
class PostUserChanged
{
    public $post;
    public $oldUser;
    public $actor;

    public function __construct(Post $post, User $oldUser = null, User $actor = null)
    {
        $this->post = $post;
        $this->oldUser = $oldUser;
        $this->actor = $actor;
    }
}
