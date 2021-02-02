<?php

namespace ClarkWinkelmann\AuthorChange\Event;

use Flarum\Post\Post;
use Flarum\User\User;

class PostUserChanged
{
    public $post;
    public $oldUser;

    public function __construct(Post $post, User $oldUser = null)
    {
        $this->post = $post;
        $this->oldUser = $oldUser;
    }
}
