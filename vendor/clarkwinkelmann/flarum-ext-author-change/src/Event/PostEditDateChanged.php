<?php

namespace ClarkWinkelmann\AuthorChange\Event;

use Carbon\Carbon;
use Flarum\Post\Post;

class PostEditDateChanged
{
    public $post;
    public $oldDate;

    public function __construct(Post $post, Carbon $oldDate = null)
    {
        $this->post = $post;
        $this->oldDate = $oldDate;
    }
}
