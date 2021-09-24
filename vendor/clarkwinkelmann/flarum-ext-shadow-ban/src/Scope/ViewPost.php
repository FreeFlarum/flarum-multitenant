<?php

namespace ClarkWinkelmann\ShadowBan\Scope;

use Flarum\Post\Post;
use Flarum\User\User;
use Illuminate\Database\Eloquent\Builder;

class ViewPost
{
    public function __invoke(User $actor, Builder $query)
    {
        // Can't use Post::class because of bug in flarum/core
        if ($actor->can('shadowHide', new Post())) {
            return;
        }

        $query->where(function (Builder $query) use ($actor) {
            $query->whereNull('shadow_hidden_at');

            if (!$actor->isGuest()) {
                $query->orWhere('posts.user_id', '=', $actor->id);
            }
        });
    }
}
