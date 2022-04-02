<?php

namespace ClarkWinkelmann\AuthorChange\Event;

use Flarum\Discussion\Discussion;
use Flarum\User\User;

/**
 * The author of a discussion was modified.
 * @property Discussion $discussion
 * @property User|null $oldUser Previous discussion author if any
 * @property User|null $actor Actor who performed the change
 */
class DiscussionUserChanged
{
    public $discussion;
    public $oldUser;
    public $actor;

    public function __construct(Discussion $discussion, User $oldUser = null, User $actor = null)
    {
        $this->discussion = $discussion;
        $this->oldUser = $oldUser;
        $this->actor = $actor;
    }
}
