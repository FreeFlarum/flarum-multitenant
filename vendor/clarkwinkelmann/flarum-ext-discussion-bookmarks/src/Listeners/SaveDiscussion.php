<?php

namespace ClarkWinkelmann\DiscussionBookmarks\Listeners;

use Carbon\Carbon;
use Flarum\Discussion\Event\Saving;

class SaveDiscussion
{
    public function handle(Saving $event)
    {
        if (isset($event->data['attributes']['bookmarked'])) {
            $event->actor->assertRegistered();

            $state = $event->discussion->stateFor($event->actor);

            $state->bookmarked_at = $event->data['attributes']['bookmarked'] ? Carbon::now() : null;
            $state->save();
        }
    }
}
