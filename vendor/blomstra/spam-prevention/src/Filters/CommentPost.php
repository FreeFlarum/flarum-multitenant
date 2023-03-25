<?php

namespace Blomstra\Spam\Filters;

use Blomstra\Spam\Concerns;
use Flarum\Post\Event\Saving;
use Illuminate\Contracts\Events\Dispatcher;

class CommentPost
{
    use Concerns\Approval,
        Concerns\Users,
        Concerns\Content;

    public function subscribe(Dispatcher $events)
    {
        $events->listen(Saving::class, [$this, 'filter']);
    }

    public function filter(Saving $event)
    {
        $discussion = $event->post->discussion;
        $post = $event->post;

        // When the user edits their first post, we need to rerun the check and hold for moderation.
        $editsFirstPost = $post->user?->posts()->count() === 1
            && $post->user->posts()->first()->is($event->post);

        if (
            // Let's check integrity of posts when the change is made by the post author only.
            $event->actor->is($post->user)
            // Ignore any elevated user.
            && ! $this->isElevatedUser($event->actor)
            // Only run the check with authors that are new or are posting for the first time.
            && ($this->isFreshUser($post->user) || $editsFirstPost)
            // Discussions that are hidden don't need to be checked.
            && $discussion->hidden_at === null
            // Only test against comment posts for now (no event posts for instance)
            && $post->type === 'comment'
            // Now actually check whether the content contains content we MAY consider spam.
            && $this->containsProblematicContent($post->content)) {
            $this->requireApproval($post, 'contains URL or email address');
        }
    }
}
