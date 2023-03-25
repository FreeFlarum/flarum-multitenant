<?php

/*
 * This file is part of blomstra/mark-unread.
 *
 * Copyright (c) 2021 Blomstra Ltd.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\MarkUnread\Listeners;

use Flarum\Discussion\Event\Saving;

class MarkUnread
{
    public function handle(Saving $event)
    {
        if (isset($event->data['attributes']['unread'])) {
            /** @var \Flarum\Discussion\UserState $state */
            $state = $event->discussion->stateFor($event->actor);
            $state->last_read_post_number = 0;
            $state->last_read_at = null;
            $state->save();
        }
    }
}
