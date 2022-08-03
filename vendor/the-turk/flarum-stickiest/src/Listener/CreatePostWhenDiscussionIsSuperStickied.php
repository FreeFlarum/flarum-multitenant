<?php

/*
 * This file is part of Stickiest.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace TheTurk\Stickiest\Listener;

use Flarum\Discussion\Discussion;
use Flarum\User\User;
use TheTurk\Stickiest\Event\DiscussionWasSuperStickied;
use TheTurk\Stickiest\Event\DiscussionWasUnSuperStickied;
use TheTurk\Stickiest\Post\DiscussionSuperStickiedPost;

class CreatePostWhenDiscussionIsSuperStickied
{
    /**
     * @param DiscussionWasSuperStickied $event
     */
    public static function whenDiscussionWasSuperStickied(DiscussionWasSuperStickied $event)
    {
        static::stickiestChanged($event->discussion, $event->user, true);
    }

    /**
     * @param DiscussionWasUnSuperStickied $event
     */
    public static function whenDiscussionWasUnSuperStickied(DiscussionWasUnSuperStickied $event)
    {
        static::stickiestChanged($event->discussion, $event->user, false);
    }

    /**
     * @param Discussion $discussion
     * @param User       $user
     * @param bool       $isStickiest
     */
    protected static function stickiestChanged(Discussion $discussion, User $user, $isStickiest)
    {
        $post = DiscussionSuperStickiedPost::reply(
            $discussion->id,
            $user->id,
            $isStickiest
        );

        $discussion->mergePost($post);
    }
}
