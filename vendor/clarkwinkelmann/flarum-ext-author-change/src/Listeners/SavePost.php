<?php

namespace ClarkWinkelmann\AuthorChange\Listeners;

use Flarum\Post\Event\Saving;

class SavePost extends AbstractSaveAuthor
{
    public function handle(Saving $event)
    {
        $this->saveAuthor($event->post, $event->actor, $event->data);
    }
}
