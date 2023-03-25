<?php

namespace ClarkWinkelmann\ShadowBan\Policy;

use Flarum\Post\CommentPost;
use Flarum\Post\Post;
use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class PostPolicy extends AbstractPolicy
{
    public function shadowHide(User $actor, Post $post): bool
    {
        // Because the ModelPrivate extender only applies to CommentPost, we'll also hide controls on other kind of posts to prevent and confusion
        // there shouldn't be any need to shadow hide other types of posts anyway
        return $post instanceof CommentPost && $actor->hasPermission('clarkwinkelmann-shadow-ban.hide');
    }
}
