<?php

/*
 * This file is part of Stickiest.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace TheTurk\Stickiest\Listener;

use Flarum\Discussion\Event\Saving;
use Flarum\Sticky\Event\DiscussionWasStickied;
use Flarum\Sticky\Event\DiscussionWasUnstickied;
use Flarum\Tags\TagRepository;
use TheTurk\Stickiest\Event\DiscussionWasSuperStickied;
use TheTurk\Stickiest\Event\DiscussionWasUnSuperStickied;

class SaveStickyToDatabase
{
    /**
     * @var TagRepository
     */
    protected $tags;

    /**
     * @param TagRepository $tags
     */
    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;
    }

    /**
     * @param Saving $event
     */
    public function handle(Saving $event)
    {
        $discussion = $event->discussion;
        $actor = $event->actor;

        if (isset($event->data['attributes']['isTagSticky'])) {
            $isTagSticky = (bool) $event->data['attributes']['isTagSticky'];

            $actor->assertCan('stickiest.tagSticky', $discussion);

            $tagSlugs = $event->data['attributes']['tagSlugs'] ?? null;

            if (!$isTagSticky || (is_array($tagSlugs) && $discussion->stickyTags->count() > 0)) {
                $discussion->stickyStates()->delete();
            }

            if (is_array($tagSlugs)) {
                foreach ($tagSlugs as $slug) {
                    $tagId = $this->tags->getIdForSlug($slug);

                    if ($tagId) {
                        $this->tags->findOrFail($tagId)->stickyStates()->create(
                            [
                                'discussion_id' => $discussion->id,
                                'tag_id'        => $tagId,
                            ]
                        );
                    }
                }
            }

            if ((bool) $discussion->is_tag_sticky !== $isTagSticky) {
                $discussion->is_tag_sticky = $isTagSticky;

                if ($discussion->is_tag_sticky) {
                    if (!$discussion->is_stickiest && !$discussion->is_sticky) {
                        $discussion->raise(new DiscussionWasStickied($discussion, $actor));
                    }
                } else {
                    if (!$discussion->is_sticky) {
                        $discussion->raise(new DiscussionWasUnstickied($discussion, $actor));
                    }
                }
            }
        }

        if (isset($event->data['attributes']['isStickiest'])) {
            $isStickiest = (bool) $event->data['attributes']['isStickiest'];

            $actor->assertCan('stickiest', $discussion);

            if ((bool) $discussion->is_stickiest === $isStickiest) {
                return;
            }

            $discussion->is_stickiest = $isStickiest;

            $discussion->raise(
                $discussion->is_stickiest
                    ? new DiscussionWasSuperStickied($discussion, $actor)
                    : new DiscussionWasUnSuperStickied($discussion, $actor)
            );
        }
    }
}
