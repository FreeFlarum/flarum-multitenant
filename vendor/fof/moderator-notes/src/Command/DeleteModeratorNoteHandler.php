<?php

/*
 * This file is part of fof/moderator-notes.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\ModeratorNotes\Command;

use FoF\ModeratorNotes\Events\ModeratorNoteDeleted;
use FoF\ModeratorNotes\Model\ModeratorNote;
use Illuminate\Events\Dispatcher;

class DeleteModeratorNoteHandler
{
    protected $events;

    public function __construct(Dispatcher $events)
    {
        $this->events = $events;
    }

    /**
     * @param DeleteModeratorNote $command
     *
     * @throws \Flarum\User\Exception\PermissionDeniedException
     *
     * @return mixed
     */
    public function handle(DeleteModeratorNote $command)
    {
        $actor = $command->actor;
        $actor->assertCan('user.deleteModeratorNotes');

        $note = ModeratorNote::findOrFail($command->noteId);

        $note->delete();

        $this->events->dispatch(new ModeratorNoteDeleted($actor, $note));

        return $note;
    }
}
