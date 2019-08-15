<?php

namespace PersianFla\Persian\Listener;

use Flarum\Discussion\Event\Started;
use Illuminate\Contracts\Events\Dispatcher;
use PersianFla\Persian\Util\Str;

class UpdateDiscussionSlug
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(Started::class, [$this, 'whenDiscussionIsStarted']);
    }

    public function whenDiscussionIsStarted(Started $event)
    {
        $event->discussion->slug = Str::slug($event->discussion->title);
    }
}
