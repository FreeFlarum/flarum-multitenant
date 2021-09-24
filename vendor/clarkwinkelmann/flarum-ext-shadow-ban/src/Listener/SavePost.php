<?php

namespace ClarkWinkelmann\ShadowBan\Listener;

use Carbon\Carbon;
use Flarum\Post\Event\Saving;
use Flarum\User\User;
use Illuminate\Support\Arr;

class SavePost
{
    public function handle(Saving $event)
    {
        $attributes = (array)Arr::get($event->data, 'attributes');

        if (Arr::exists($attributes, 'isShadowHidden')) {
            $event->actor->assertCan('shadowHide', $event->post);

            $event->post->shadow_hidden_at = $attributes['isShadowHidden'] ? Carbon::now() : null;
        }

        if (!$event->post->exists && $event->post->user_id) {
            $user = User::find($event->post->user_id);

            if ($user && $user->shadow_banned_until && $user->shadow_banned_until->isFuture()) {
                $event->post->shadow_hidden_at = Carbon::now();
            }
        }
    }
}
