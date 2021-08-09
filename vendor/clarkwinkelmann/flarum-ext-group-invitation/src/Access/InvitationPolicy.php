<?php

namespace ClarkWinkelmann\GroupInvitation\Access;

use ClarkWinkelmann\GroupInvitation\Invitation;
use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class InvitationPolicy extends AbstractPolicy
{
    public function use(User $actor, Invitation $invitation): bool
    {
        return $actor->hasPermission('clarkwinkelmann-group-invitation.use') && $invitation->hasUsagesLeft();
    }
}
