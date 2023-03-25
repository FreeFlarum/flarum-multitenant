<?php

namespace Blomstra\Spam\Concerns;

use Flarum\Extension\ExtensionManager;
use Flarum\Flags\Flag;
use Flarum\Post\Post;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Approval
{
    use Users;

    protected function requireApproval(Post $post, string $reason = null)
    {
        /** @var ExtensionManager $extensions */
        $extensions = resolve(ExtensionManager::class);

        if ($extensions->isEnabled('flarum-approval')) {
            $post->is_approved = false;

            $post->afterSave(function (Post $post) use ($reason, $extensions) {
                $this->unapproveAndFlag($post, $reason);
            });

            return true;
        }

        return false;
    }

    protected function unapproveAndFlag(Post $post, string $reason = null)
    {
        /** @var ExtensionManager $extensions */
        $extensions = resolve(ExtensionManager::class);

        if ($extensions->isEnabled('flarum-approval') && $post->number === 1) {
            $post->discussion->is_approved = false;
            $post->discussion->save();
        }

        if ($extensions->isEnabled('flarum-flags')) {
            /** @var HasMany $flags */
            $flags = $post->flags();

            // Only add the flag once.
            if ($flags->where('reason', 'Blocked by spam prevention')->doesntExist()) {
                $flag = new Flag;

                $flag->post_id = $post->id;
                $flag->type = $extensions->isEnabled('flarum-approval') ? 'approval' : 'user';
                $flag->reason = 'Blocked by spam prevention';
                $flag->reason_detail = $reason;
                $flag->user()->associate($this->getModerator());
                $flag->created_at = time();

                $flag->save();
            }
        }

        return true;
    }
}
