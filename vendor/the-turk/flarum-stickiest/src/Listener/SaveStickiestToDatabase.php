<?php

/*
 * This file is part of Stickiest.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace TheTurk\Stickiest\Listener;

use Flarum\Discussion\Event\Saving;
use TheTurk\Stickiest\Event\DiscussionWasSuperStickied;
use TheTurk\Stickiest\Event\DiscussionWasUnSuperStickied;

class SaveStickiestToDatabase
{
    /**
     * @param Saving $event
     */
    public function handle(Saving $event)
    {
        if (isset($event->data['attributes']['isStickiest'])) {
            $isStickiest = (bool) $event->data['attributes']['isStickiest'];
            $discussion = $event->discussion;
            $actor = $event->actor;

            $actor->assertCan('stickiest', $discussion);

            if ((bool) $discussion->is_stickiest === $isStickiest) {
                return;
            }

            $discussion->is_sticky = !$isStickiest;
            $discussion->is_stickiest = $isStickiest;
            
            $discussion->raise(
                $discussion->is_stickiest
                    ? new DiscussionWasSuperStickied($discussion, $actor)
                    : new DiscussionWasUnSuperStickied($discussion, $actor)
            );
        }
    }
}
