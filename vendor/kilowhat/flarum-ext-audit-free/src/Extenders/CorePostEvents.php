<?php

namespace Kilowhat\Audit\Extenders;

use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Flarum\Post\Event;
use Flarum\Post\Post;
use Illuminate\Contracts\Container\Container;
use Kilowhat\Audit\AuditLogger;

class CorePostEvents implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        $container['events']->listen(Event\Deleted::class, [$this, 'deleted']);
        $container['events']->listen(Event\Hidden::class, [$this, 'hidden']);
        $container['events']->listen(Event\Posted::class, [$this, 'posted']);
        $container['events']->listen(Event\Restored::class, [$this, 'restored']);
        $container['events']->listen(Event\Revised::class, [$this, 'revised']);
    }

    protected function log(Post $post, string $action, array $payload = [])
    {
        AuditLogger::log("post.$action", array_merge([
            'discussion_id' => $post->discussion->id,
            'post_id' => $post->id,
        ], $payload));
    }

    public function deleted(Event\Deleted $event)
    {
        $this->log($event->post, 'deleted');
    }

    public function hidden(Event\Hidden $event)
    {
        $this->log($event->post, 'hidden');
    }

    public function posted(Event\Posted $event)
    {
        // Not logging the first post. There's always going to be one created alongside with the discussion
        // (at least with Flarum core)
        if ($event->post->number === 1) {
            return;
        }

        $this->log($event->post, 'created');
    }

    public function restored(Event\Restored $event)
    {
        $this->log($event->post, 'restored');
    }

    public function revised(Event\Revised $event)
    {
        $this->log($event->post, 'revised');
    }
}
