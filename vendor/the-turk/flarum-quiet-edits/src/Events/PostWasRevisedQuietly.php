<?php
namespace TheTurk\QuietEdits\Events;

use Flarum\Post\CommentPost;
use Flarum\User\User;

class PostWasRevisedQuietly
{
    /**
     * @var \Flarum\Post\CommentPost
     */
    public $post;

    /**
     * @var User
     */
    public $actor;

    /**
     * @param \Flarum\Post\CommentPost $post
     */
    public function __construct(CommentPost $post, User $actor = null)
    {
        $this->post = $post;
        $this->actor = $actor;
    }
}
