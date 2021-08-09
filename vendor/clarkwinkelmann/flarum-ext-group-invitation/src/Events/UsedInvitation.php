<?php

namespace ClarkWinkelmann\GroupInvitation\Events;

use ClarkWinkelmann\GroupInvitation\Invitation;
use Flarum\User\User;

class UsedInvitation
{
    public $actor;
    public $invitation;

    public function __construct(User $actor, Invitation $invitation)
    {
        $this->actor = $actor;
        $this->invitation = $invitation;
    }
}
