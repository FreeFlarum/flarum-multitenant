<?php

namespace ClarkWinkelmann\ShadowBan\Policy;

use Flarum\Post\Post;
use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class PostPolicy extends AbstractPolicy
{
    /**
     * @param User $actor
     * @param Post|string $post Post model or ::class
     * @return bool
     */
    public function shadowHide(User $actor, $post = '')
    {
        return $actor->hasPermission('clarkwinkelmann-shadow-ban.hide');
    }
}
