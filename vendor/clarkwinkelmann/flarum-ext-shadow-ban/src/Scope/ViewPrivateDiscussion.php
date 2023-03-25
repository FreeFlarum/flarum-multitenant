<?php

namespace ClarkWinkelmann\ShadowBan\Scope;

use Flarum\User\User;
use Illuminate\Database\Eloquent\Builder;

class ViewPrivateDiscussion
{
    public function __invoke(User $actor, Builder $query)
    {
        if ($actor->hasPermission('clarkwinkelmann-shadow-ban.hide')) {
            $query->orWhereNotNull('discussions.shadow_hidden_at');
        } else if (!$actor->isGuest()) {
            $query->orWhere(function (Builder $query) use ($actor) {
                $query->whereNotNull('discussions.shadow_hidden_at')
                    ->where('discussions.user_id', '=', $actor->id);
            });
        }
    }
}
