<?php

namespace ClarkWinkelmann\FirstPostApproval\Listeners;

use Flarum\Flags\Flag;
use Flarum\Post\Event\Saving;
use Flarum\Post\Post;
use Flarum\Settings\SettingsRepositoryInterface;

class UnapproveNewPosts
{
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function handle(Saving $event)
    {
        $post = $event->post;

        if ($post->exists || $event->actor->can('firstPostWithoutApproval', $post->discussion)) {
            return;
        }

        $discussionCount = $this->settings->get('clarkwinkelmann-first-post-approval.discussionCount');

        if ($post->discussion->first_post_id === null && $discussionCount) {
            // If this is a new discussion and if a rule has been defined for new discussions
            if ($event->actor->first_discussion_approval_count >= $discussionCount) {
                return;
            }
        } else {
            // If this is a reply, or if there's no rule defined for new discussions
            if (($event->actor->first_discussion_approval_count + $event->actor->first_post_approval_count) >= $this->settings->get('clarkwinkelmann-first-post-approval.postCount')) {
                return;
            }
        }

        $post->is_approved = false;

        $post->afterSave(function (Post $post) {
            if ($post->number == 1) {
                $post->discussion->is_approved = false;
                $post->discussion->save();
            }

            $flag = new Flag();

            $flag->post_id = $post->id;
            $flag->type = 'approval';
            $flag->created_at = time();

            $flag->save();
        });
    }
}
