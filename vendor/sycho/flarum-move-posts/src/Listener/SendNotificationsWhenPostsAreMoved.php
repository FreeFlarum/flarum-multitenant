<?php

namespace SychO\MovePosts\Listener;

use Flarum\Notification\NotificationSyncer;
use Flarum\Post\CommentPost;
use SychO\MovePosts\Event\PostsMoved;
use SychO\MovePosts\Notification\PostMovedBlueprint;

class SendNotificationsWhenPostsAreMoved
{
    /**
     * @var NotificationSyncer
     */
    protected $notifications;

    /**
     * @param NotificationSyncer $notifications
     */
    public function __construct(NotificationSyncer $notifications)
    {
        $this->notifications = $notifications;
    }

    public function handle(PostsMoved $event)
    {
        $actor = $event->actor;
        $posts = $event->posts
            ->unique('user_id')
            ->filter(function (CommentPost $post) use ($actor) {
                return $post->user_id !== $actor->id;
            });

        $this->notifications->sync(
            new PostMovedBlueprint($event->targetDiscussion, $event->sourceDiscussion),
            $posts->pluck('user')->all()
        );
    }
}
