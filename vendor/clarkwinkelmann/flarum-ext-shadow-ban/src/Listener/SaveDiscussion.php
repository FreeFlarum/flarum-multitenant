<?php

namespace ClarkWinkelmann\ShadowBan\Listener;

use Carbon\Carbon;
use ClarkWinkelmann\ShadowBan\Event\ShadowHiddenDiscussion;
use ClarkWinkelmann\ShadowBan\Event\ShadowRestoredDiscussion;
use Flarum\Discussion\Event\Saving;
use Flarum\User\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Arr;

class SaveDiscussion
{
    protected $events;

    public function __construct(Dispatcher $events)
    {
        $this->events = $events;
    }

    public function handle(Saving $event)
    {
        $attributes = (array)Arr::get($event->data, 'attributes');

        if (Arr::exists($attributes, 'isShadowHidden')) {
            $event->actor->assertCan('shadowHide', $event->discussion);

            $event->discussion->shadow_hidden_at = $attributes['isShadowHidden'] ? Carbon::now() : null;

            if ($attributes['isShadowHidden']) {
                $event->discussion->raise(new ShadowHiddenDiscussion($event->discussion, $event->actor));
            } else {
                $event->discussion->raise(new ShadowRestoredDiscussion($event->discussion, $event->actor));
            }
        }

        if (!$event->discussion->exists && $event->discussion->user_id) {
            $user = User::find($event->discussion->user_id);

            if ($user && $user->shadow_banned_until && $user->shadow_banned_until->isFuture()) {
                $event->discussion->shadow_hidden_at = Carbon::now();

                // Manually dispatch the event here so we can keep $actor null to signal it was done automatically
                $event->discussion->afterSave(function ($discussion) {
                    $this->events->dispatch(new ShadowHiddenDiscussion($discussion));
                });
            }
        }
    }
}
