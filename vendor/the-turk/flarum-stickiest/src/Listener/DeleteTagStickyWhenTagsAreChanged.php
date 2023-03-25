<?php

/*
 * This file is part of Stickiest.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace TheTurk\Stickiest\Listener;

use Flarum\Tags\Event\DiscussionWasTagged;

class DeleteTagStickyWhenTagsAreChanged
{
    /**
     * @param DiscussionWasTagged $event
     *
     * @return void
     */
    public function handle(DiscussionWasTagged $event)
    {
        $isTagSticky = (bool) $event->discussion->is_tag_sticky;
        $stickyTags = $event->discussion->stickyTags;

        if (!($isTagSticky && $stickyTags->count() > 0)) {
            return;
        }

        $bastardTagIds = [];
        $deletedBastards = 0;

        foreach ($stickyTags as $tag) {
            if ($event->discussion->tags->contains($tag)) {
                continue;
            }

            $bastardTagIds[] = $tag->id;
        }

        foreach ($bastardTagIds as $tagId) {
            $deletedBastards += $event->discussion->stickyStates()->whereTagId($tagId)->delete();
        }

        if ($stickyTags->count() == $deletedBastards) {
            $event->discussion->is_tag_sticky = false;
            $event->discussion->is_sticky = true;
            $event->discussion->save();
        }
    }
}
