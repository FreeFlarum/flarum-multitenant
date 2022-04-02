<?php

namespace Kilowhat\Audit\Extenders;

use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Flarum\Flags\Flag;
use Flarum\Post\Post;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kilowhat\Audit\AuditLogger;

class FlarumFlagsEvents implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        if (!class_exists(Flag::class)) {
            return;
        }

        Flag::created(function (Flag $flag) {
            // We only log flags created manually via the extension
            // We don't log the creation of Approval/Akismet flags
            if ($flag->type !== 'user') {
                return;
            }

            AuditLogger::log('post.flagged', [
                'discussion_id' => $flag->post->discussion->id,
                'post_id' => $flag->post->id,
                'reason' => $flag->reason ?? ($flag->reason_detail ? 'other' : null),
            ]);
        });

        // We don't use the FlagsWillBeDeleted event as extensions might still prevent deletion at that point
        // Will require changes when https://github.com/flarum/flags/pull/21 is merged
        HasMany::macro('delete', function () {
            /**
             * @var $this HasMany
             */

            $parent = $this->getParent();

            $shouldLog = false;

            // Additional logic for logging
            // because flarum/flags calls this every time a post is deleted, we need to check if there were actual flags
            if ($parent instanceof Post && $this->getQuery()->getModel() instanceof Flag && $this->getQuery()->count()) {
                $shouldLog = true;
            }

            // Replicates code from Relation::__call
            $result = $this->forwardCallTo($this->getQuery(), 'delete', func_get_args());

            if ($shouldLog) {
                AuditLogger::log('post.dismissed_flags', [
                    'discussion_id' => $parent->discussion->id,
                    'post_id' => $parent->id,
                ]);
            }

            // Replicates code from Relation::__call
            if ($result === $this->getQuery()) {
                return $this;
            }

            return $result;
        });
    }
}
