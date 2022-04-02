<?php

namespace ClarkWinkelmann\ShadowBan\Event;

use Flarum\Discussion\Discussion;
use Flarum\User\User;

/**
 * When a discussion is manually restored from shadow-hide.
 *
 * @property Discussion $discussion
 * @property User $actor
 */
class ShadowRestoredDiscussion
{
    public $discussion;
    public $actor;

    public function __construct(Discussion $discussion, User $actor)
    {
        $this->discussion = $discussion;
        $this->actor = $actor;
    }
}
