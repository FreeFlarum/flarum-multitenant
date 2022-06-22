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

use Flarum\User\User;

class DeleteModeratorNote
{
    /**
     * The ID of the note.
     *
     * @var int
     */
    public $noteId;

    /**
     * The user performing the action.
     *
     * @var User
     */
    public $actor;

    /**
     * DeleteModeratorNote constructor.
     *
     * @param $noteId
     * @param User $actor
     */
    public function __construct($noteId, User $actor)
    {
        $this->noteId = $noteId;
        $this->actor = $actor;
    }
}
