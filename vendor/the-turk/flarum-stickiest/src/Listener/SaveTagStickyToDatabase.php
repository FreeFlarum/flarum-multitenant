<?php

/*
 * This file is part of Stickiest.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace TheTurk\Stickiest\Listener;

use Flarum\Discussion\Event\Saving;

class SaveTagStickyToDatabase
{
    /**
     * @param Saving $event
     */
    public function handle(Saving $event)
    {
        if (isset($event->data['attributes']['isTagSticky'])) {
            $isTagSticky = (bool) $event->data['attributes']['isTagSticky'];
            $discussion = $event->discussion;
            $actor = $event->actor;

            $actor->assertCan('stickiest.tagSticky', $discussion);

            if ((bool) $discussion->is_tagSticky === $isTagSticky) {
                return;
            }

            $discussion->is_tagSticky = $isTagSticky;
        }
    }
}
