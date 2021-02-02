<?php

namespace ClarkWinkelmann\AuthorChange\Event;

use Carbon\Carbon;
use Flarum\Post\Post;

class PostCreateDateChanged
{
    public $post;
    public $oldDate;

    public function __construct(Post $post, Carbon $oldDate)
    {
        $this->post = $post;
        $this->oldDate = $oldDate;
    }
}
