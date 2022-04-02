<?php

/*
 * This file is part of askvortsov/flarum-discussion-templates
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Askvortsov\FlarumDiscussionTemplates\Access;

use Flarum\Discussion\Discussion;
use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class DiscussionPolicy extends AbstractPolicy
{
    /**
     * @param User       $actor
     * @param string     $ability
     * @param Discussion $discussion
     *
     * @return bool
     */
    public function manageReplyTemplates(User $actor, Discussion $discussion)
    {
        return $actor->can('manageAllReplyTemplates', $discussion) || $actor->id === $discussion->user_id && $actor->can('manageOwnDiscussionReplyTemplates', $discussion);
    }
}
