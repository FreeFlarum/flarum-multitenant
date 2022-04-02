<?php

namespace Kilowhat\Audit\Extenders;

use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Flarum\Approval\Event;
use Illuminate\Contracts\Container\Container;
use Kilowhat\Audit\AuditLogger;

class FlarumApprovalEvents implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        $container['events']->listen(Event\PostWasApproved::class, [$this, 'approved']);
    }

    public function approved(Event\PostWasApproved $event)
    {
        AuditLogger::log('post.approved', [
            'discussion_id' => $event->post->discussion->id,
            'post_id' => $event->post->id,
        ]);
    }
}
