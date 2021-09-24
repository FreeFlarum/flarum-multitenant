<?php

namespace ClarkWinkelmann\ShadowBan\Listener;

use Carbon\Carbon;
use Flarum\Discussion\Event\Saving;
use Flarum\User\User;
use Illuminate\Support\Arr;

class SaveDiscussion
{
    public function handle(Saving $event)
    {
        $attributes = (array)Arr::get($event->data, 'attributes');

        if (Arr::exists($attributes, 'isShadowHidden')) {
            $event->actor->assertCan('shadowHide', $event->discussion);

            $event->discussion->shadow_hidden_at = $attributes['isShadowHidden'] ? Carbon::now() : null;
        }

        if (!$event->discussion->exists && $event->discussion->user_id) {
            $user = User::find($event->discussion->user_id);

            if ($user && $user->shadow_banned_until && $user->shadow_banned_until->isFuture()) {
                $event->discussion->shadow_hidden_at = Carbon::now();
            }
        }
    }
}
