<?php

namespace Kilowhat\Audit\Extenders;

use Flarum\Discussion\Discussion;
use Flarum\Lock\Event;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;
use Kilowhat\Audit\AuditLogger;

class FlarumLockEvents implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        $container['events']->listen(Event\DiscussionWasLocked::class, [$this, 'locked']);
        $container['events']->listen(Event\DiscussionWasUnlocked::class, [$this, 'unlocked']);
    }

    protected function log(Discussion $discussion, string $action, array $payload = [])
    {
        AuditLogger::log("discussion.$action", array_merge([
            'discussion_id' => $discussion->id,
        ], $payload));
    }

    public function locked(Event\DiscussionWasLocked $event)
    {
        $this->log($event->discussion, 'locked');
    }

    public function unlocked(Event\DiscussionWasUnlocked $event)
    {
        $this->log($event->discussion, 'unlocked');
    }
}
