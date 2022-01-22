<?php

namespace ClarkWinkelmann\ShadowBan\Event;

use Flarum\Discussion\Discussion;
use Flarum\User\User;

/**
 * Dispatched when a discussion is shadow-hidden manually or automatically.
 *
 * @property Discussion $discussion
 * @property User|null $actor Actor if manually hidden, or null if hidden automatically because of a user ban
 */
class ShadowHiddenDiscussion
{
    public $discussion;
    public $actor;

    public function __construct(Discussion $discussion, User $actor = null)
    {
        $this->discussion = $discussion;
        $this->actor = $actor;
    }
}
