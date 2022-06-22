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

use Flarum\Foundation\ValidationException;
use FoF\ModeratorNotes\Events\ModeratorNoteCreated;
use FoF\ModeratorNotes\Model\ModeratorNote;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Carbon;
use Symfony\Contracts\Translation\TranslatorInterface;

class CreateModeratorNoteHandler
{
    /** @var Dispatcher */
    protected $events;

    /** @var TranslatorInterface */
    protected $translator;

    public function __construct(Dispatcher $events, TranslatorInterface $translator)
    {
        $this->events = $events;
        $this->translator = $translator;
    }

    /**
     * @param CreateNote $command
     *
     * @return ModeratorNote
     */
    public function handle(CreateModeratorNote $command)
    {
        $actor = $command->actor;
        $user_id = $command->user_id;
        $notecontent = $command->note;
        $formatter = ModeratorNote::getFormatter();

        $note = new ModeratorNote();
        $note->user_id = $user_id;
        $note->note = $formatter->parse($notecontent);
        $note->added_by_user_id = $actor->id;
        $note->created_at = Carbon::now();

        if ($notecontent === '') {
            throw new ValidationException(['message' => $this->translator->trans('fof-moderator-notes.forum.no_content_given')]);
        }

        $note->save();

        $this->events->dispatch(new ModeratorNoteCreated($actor, $note));

        return $note;
    }
}
