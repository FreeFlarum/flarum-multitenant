<?php

/*
 * This file is part of fof/moderator-notes.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use FoF\ModeratorNotes\Model\ModeratorNote;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $formatter = ModeratorNote::getFormatter();

        ModeratorNote::chunkById(1000, function ($moderatorNote) use ($formatter) {
            foreach ($moderatorNote as $note) {
                $note->note = $formatter->parse($note->note);
                $note->save();
            }
        });
    },

    'down' => function (Builder $schema) {
        // changes should be kept
    },
];
