<?php

namespace ClarkWinkelmann\AuthorChange\Listeners;

use Flarum\Discussion\Event\Saving;

class SaveDiscussion extends AbstractSaveAuthor
{
    public function handle(Saving $event)
    {
        $this->saveAuthor($event->discussion, $event->actor, $event->data);
    }
}
