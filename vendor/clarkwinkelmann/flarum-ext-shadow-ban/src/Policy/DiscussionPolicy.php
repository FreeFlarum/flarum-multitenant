<?php

namespace ClarkWinkelmann\ShadowBan\Policy;

use Flarum\Discussion\Discussion;
use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class DiscussionPolicy extends AbstractPolicy
{
    /**
     * @param User $actor
     * @param Discussion|string $discussion Discussion model or ::class
     * @return bool
     */
    public function shadowHide(User $actor, $discussion = '')
    {
        return $actor->hasPermission('clarkwinkelmann-shadow-ban.hide');
    }
}
