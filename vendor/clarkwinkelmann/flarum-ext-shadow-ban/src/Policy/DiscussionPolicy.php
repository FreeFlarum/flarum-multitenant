<?php

namespace ClarkWinkelmann\ShadowBan\Policy;

use Flarum\Discussion\Discussion;
use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class DiscussionPolicy extends AbstractPolicy
{
    public function shadowHide(User $actor, Discussion $discussion): bool
    {
        return $actor->hasPermission('clarkwinkelmann-shadow-ban.hide');
    }
}
