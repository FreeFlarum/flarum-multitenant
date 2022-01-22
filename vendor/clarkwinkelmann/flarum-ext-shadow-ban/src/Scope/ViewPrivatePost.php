<?php

namespace ClarkWinkelmann\ShadowBan\Scope;

use Flarum\User\User;
use Illuminate\Database\Eloquent\Builder;

class ViewPrivatePost
{
    public function __invoke(User $actor, Builder $query)
    {
        if ($actor->hasPermission('clarkwinkelmann-shadow-ban.hide')) {
            $query->orWhereNotNull('posts.shadow_hidden_at');
        } else if (!$actor->isGuest()) {
            $query->orWhere(function (Builder $query) use ($actor) {
                $query->whereNotNull('posts.shadow_hidden_at')
                    ->where('posts.user_id', '=', $actor->id);
            });
        }
    }
}
