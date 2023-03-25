<?php

/*
 * This file is part of askvortsov/flarum-discussion-templates
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Askvortsov\FlarumDiscussionTemplates\Listener;

use Flarum\Discussion\Event\Saving;
use Illuminate\Support\Arr;

class SaveReplyTemplateToDatabase
{
    public function handle(Saving $event)
    {
        $discussion = $event->discussion;
        $data = $event->data;
        $actor = $event->actor;

        $attributes = Arr::get($data, 'attributes', []);

        if (isset($attributes['replyTemplate'])) {
            $actor->assertCan('manageReplyTemplates', $discussion);

            $discussion->replyTemplate = $attributes['replyTemplate'];
        }
    }
}
