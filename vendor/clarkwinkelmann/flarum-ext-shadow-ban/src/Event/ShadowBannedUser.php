<?php

namespace ClarkWinkelmann\ShadowBan\Event;

use Carbon\Carbon;
use Flarum\User\User;

/**
 * Dispatched when a user is manually shadow-banned.
 *
 * @property User $user
 * @property User $actor
 * @property Carbon|null $previouslyBannedUntil Previous ban end if the date was changed
 */
class ShadowBannedUser
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
