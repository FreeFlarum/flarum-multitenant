<?php

/*
 * This file is part of fof/moderator-notes.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\ModeratorNotes\Api\Serializer;

use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Api\Serializer\BasicUserSerializer;
use Flarum\Post\Post;
use FoF\ModeratorNotes\Model\ModeratorNote;

class ModeratorNotesSerializer extends AbstractSerializer
{
    protected $type = 'moderatorNotes';

    /**
     * Get the default set of serialized attributes for a model.
     *
     * @param object|array $model
     *
     * @return array
     */
    protected function getDefaultAttributes($moderatorNote)
    {
        return [
            'id'        => $moderatorNote->id,
            'userId'    => $moderatorNote->user_id,
            'note'      => $this->format($moderatorNote->note),
            'createdAt' => $this->formatDate($moderatorNote->created_at),
        ];
    }

    protected function addedByUser($moderatorNote)
    {
        return $this->hasOne($moderatorNote, BasicUserSerializer::class);
    }

    protected function format($note)
    {
        $formatter = ModeratorNote::getFormatter();

        return $formatter->render($note, new Post());
    }
}
