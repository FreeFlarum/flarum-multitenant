<?php

namespace ClarkWinkelmann\AuthorChange\Event;

use Carbon\Carbon;
use Flarum\Post\Post;
use Flarum\User\User;

/**
 * The creation date of a post was modified.
 * @property Post $post
 * @property Carbon|null $oldDate Previous creation date
 * @property User|null $actor Actor who performed the change
 */
class PostCreateDateChanged
{
    public $post;
    public $oldDate;
    public $actor;

    public function __construct(Post $post, Carbon $oldDate, User $actor = null)
    {
        $this->post = $post;
        $this->oldDate = $oldDate;
        $this->actor = $actor;
    }
}
