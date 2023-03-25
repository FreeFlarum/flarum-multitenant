<?php

/*
 * This file is part of askvortsov/flarum-help-tags
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Askvortsov\FlarumHelpTags\Listener;

use Flarum\Discussion\Event\Saving;

class SaveShowToAllToDatabase
{
    /**
     * @param Saving $event
     */
    public function handle(Saving $event)
    {
        if (isset($event->data['attributes']['showToAll'])) {
            $showToAll = (bool) $event->data['attributes']['showToAll'];
            $discussion = $event->discussion;
            $actor = $event->actor;

            $actor->assertAdmin();

            if ((bool) $discussion->show_to_all === $showToAll) {
                return;
            }

            $discussion->show_to_all = $showToAll;
        }
    }
}
