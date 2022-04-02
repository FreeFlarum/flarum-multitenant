<?php

namespace ClarkWinkelmann\FirstPostApproval\Listeners;

use Flarum\Approval\Event\PostWasApproved;

class CountPostApprovals
{
    public function handle(PostWasApproved $event)
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
