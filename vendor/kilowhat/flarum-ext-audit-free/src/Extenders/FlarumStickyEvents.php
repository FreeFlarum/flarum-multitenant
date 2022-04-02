<?php

namespace Kilowhat\Audit\Extenders;

use Flarum\Discussion\Discussion;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Flarum\Sticky\Event;
use Illuminate\Contracts\Container\Container;
use Kilowhat\Audit\AuditLogger;

class FlarumStickyEvents implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        $container['events']->listen(Event\DiscussionWasStickied::class, [$this, 'stickied']);
        $container['events']->listen(Event\DiscussionWasUnstickied::class, [$this, 'unstickied']);
    }

    protected function log(Discussion $discussion, string $action, array $payload = [])
    {
        AuditLogger::log("discussion.$action", array_merge([
            'discussion_id' => $discussion->id,
        ], $payload));
    }

    public function stickied(Event\DiscussionWasStickied $event)
    {
        $this->log($event->discussion, 'stickied');
    }

    public function unstickied(Event\DiscussionWasUnstickied $event)
    {
        $this->log($event->discussion, 'unstickied');
    }
}
