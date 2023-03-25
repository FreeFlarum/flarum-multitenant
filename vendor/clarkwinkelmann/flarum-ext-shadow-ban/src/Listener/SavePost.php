<?php

namespace ClarkWinkelmann\ShadowBan\Listener;

use Carbon\Carbon;
use ClarkWinkelmann\ShadowBan\Event\ShadowHiddenPost;
use ClarkWinkelmann\ShadowBan\Event\ShadowRestoredPost;
use Flarum\Discussion\Discussion;
use Flarum\Post\CommentPost;
use Flarum\Post\Event\Saving;
use Flarum\User\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Arr;

class SavePost
{
    protected $events;

    public function __construct(Dispatcher $events)
    {
        $this->events = $events;
    }

    public function handle(Saving $event)
    {
        $attributes = (array)Arr::get($event->data, 'attributes');

        if (Arr::exists($attributes, 'isShadowHidden')) {
            $event->actor->assertCan('shadowHide', $event->post);

            $event->post->shadow_hidden_at = $attributes['isShadowHidden'] ? Carbon::now() : null;

            if ($attributes['isShadowHidden']) {
                $event->post->raise(new ShadowHiddenPost($event->post, $event->actor));
            } else {
                $event->post->raise(new ShadowRestoredPost($event->post, $event->actor));
            }

            // Refresh discussion meta, just like Flarum would if the post was deleted/restored
            // We don't need to do it after a new post because that's handled by Flarum, however we need it here
            $event->post->afterSave(function (CommentPost $post) {
                $discussion = $post->discussion;

                $discussion->refreshCommentCount();
                $discussion->refreshLastPost();
                $discussion->refreshParticipantCount();
                $discussion->save();
            });
        }

        if (!$event->post->exists && $event->post->user_id && $event->post instanceof CommentPost) {
            $user = User::find($event->post->user_id);

            if ($user && $user->shadow_banned_until && $user->shadow_banned_until->isFuture()) {
                $discussion = Discussion::find($event->post->discussion_id);

                // Don't shadow-hide the first post of a discussion since the discussion is already hidden in that situation
                if ($discussion->post_number_index > 0) {
                    $event->post->shadow_hidden_at = Carbon::now();

                    // Manually dispatch the event here so we can keep $actor null to signal it was done automatically
                    $event->post->afterSave(function ($post) {
                        $this->events->dispatch(new ShadowHiddenPost($post));
                    });
                }
            }
        }
    }
}
