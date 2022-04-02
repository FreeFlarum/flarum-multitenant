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

class CreateModeratorNote
{
    /**
     * The user performing the action.
     *
     * @var User
     */
    public $actor;

    /**
     * The user to attach the note to.
     *
     * @var int
     */
    public $user_id;

    /**
     * The content of the new note.
     *
     * @var string
     */
    public $note;

    /**
     * @param User  $actor The user performing the action.
     * @param array $data  The attributes of the new note.
     */
    public function __construct(User $actor, int $user_id, string $note)
    {
        $this->actor = $actor;
        $this->user_id = $user_id;
        $this->note = $note;
    }
}
