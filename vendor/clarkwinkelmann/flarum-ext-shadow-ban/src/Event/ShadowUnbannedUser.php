<?php

namespace ClarkWinkelmann\ShadowBan\Event;

use Carbon\Carbon;
use Flarum\User\User;

/**
 * When a user is manually removed from shadow ban.
 * No event is dispatched when the ban naturally expires.
 *
 * @property User $user
 * @property User $actor
 * @property Carbon|null $previouslyBannedUntil
 */
class ShadowUnbannedUser
{
    public $user;
    public $actor;
    public $previouslyBannedUntil;

    public function __construct(User $user, User $actor, Carbon $previouslyBannedUntil = null)
    {
        $this->user = $user;
        $this->actor = $actor;
        $this->previouslyBannedUntil = $previouslyBannedUntil;
    }
}
