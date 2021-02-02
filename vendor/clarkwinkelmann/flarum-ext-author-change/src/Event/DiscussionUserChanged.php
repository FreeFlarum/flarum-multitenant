<?php

namespace ClarkWinkelmann\AuthorChange\Event;

use Flarum\Discussion\Discussion;
use Flarum\User\User;

class DiscussionUserChanged
{
    public $discussion;
    public $oldUser;

    public function __construct(Discussion $discussion, User $oldUser = null)
    {
        $this->discussion = $discussion;
        $this->oldUser = $oldUser;
    }
}
