<?php

namespace Kilowhat\Audit\Extenders;

use Flarum\Discussion\Discussion;
use Flarum\Discussion\Event;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;
use Kilowhat\Audit\AuditLogger;

class CoreDiscussionEvents implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        $container['events']->listen(Event\Deleted::class, [$this, 'deleted']);
        $container['events']->listen(Event\Hidden::class, [$this, 'hidden']);
        $container['events']->listen(Event\Renamed::class, [$this, 'renamed']);
        $container['events']->listen(Event\Restored::class, [$this, 'restored']);
        $container['events']->listen(Event\Started::class, [$this, 'started']);
    }

    protected function log(Discussion $discussion, string $action, array $payload = [])
    {
        AuditLogger::log("discussion.$action", array_merge([
            'discussion_id' => $discussion->id,
        ], $payload));
    }

    public function deleted(Event\Deleted $event)
    {
        $this->log($event->discussion, 'deleted');
    }

    public function hidden(Event\Hidden $event)
    {
        $this->log($event->discussion, 'hidden');
    }

    public function renamed(Event\Renamed $event)
    {
        $this->log($event->discussion, 'renamed', [
            'old_title' => $event->oldTitle,
            'new_title' => $event->discussion->title,
        ]);
    }

    public function restored(Event\Restored $event)
    {
        $this->log($event->discussion, 'restored');
    }

    public function started(Event\Started $event)
    {
        $this->log($event->discussion, 'created');
    }
}
