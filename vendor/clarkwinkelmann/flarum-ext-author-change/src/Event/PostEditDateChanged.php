<?php

namespace ClarkWinkelmann\AuthorChange\Event;

use Carbon\Carbon;
use Flarum\Post\Post;
use Flarum\User\User;

/**
 * The edit date of a post was modified.
 * @property Post $post
 * @property Carbon|null $oldDate Previous edit date
 * @property User|null $actor Actor who performed the change
 */
class PostEditDateChanged
{
    public $post;
    public $oldDate;
    public $actor;

    public function __construct(Post $post, Carbon $oldDate = null, User $actor = null)
    {
        $this->post = $post;
        $this->oldDate = $oldDate;
        $this->actor = $actor;
    }
}
