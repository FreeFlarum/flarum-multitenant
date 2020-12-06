<?php


namespace ClarkWinkelmann\FirstPostApproval\Extenders;

use Flarum\Approval\Event\PostWasApproved;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

class CountPostApprovals implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        $container['events']->listen(PostWasApproved::class, [$this, 'approved']);
    }

    public function approved(PostWasApproved $event)
    {
        $user = $event->post->user;

        if (!$user) {
            return;
        }

        // Do not count posts if they were hidden (which approves them)
        if ($event->post->hidden_at) {
            return;
        }

        if ($event->post->number == 1) {
            $user->first_discussion_approval_count++;
        } else {
            $user->first_post_approval_count++;
        }

        $user->save();
    }
}
