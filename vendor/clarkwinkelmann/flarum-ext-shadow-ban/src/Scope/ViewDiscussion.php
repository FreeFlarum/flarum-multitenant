<?php

namespace ClarkWinkelmann\ShadowBan\Scope;

use Flarum\Discussion\Discussion;
use Flarum\User\User;
use Illuminate\Database\Eloquent\Builder;

class ViewDiscussion
{
    public function __invoke(User $actor, Builder $query)
    {
        // Can't use Discussion::class because of bug in flarum/tags
        if ($actor->can('shadowHide', new Discussion())) {
            return;
        }

        $query->where(function (Builder $query) use ($actor) {
            $query->whereNull('discussions.shadow_hidden_at');

            if (!$actor->isGuest()) {
                $query->orWhere('discussions.user_id', '=', $actor->id);
            }
        });
    }
}
