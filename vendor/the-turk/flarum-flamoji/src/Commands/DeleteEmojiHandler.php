<?php

namespace TheTurk\Flamoji\Commands;

use TheTurk\Flamoji\Models\Emoji;

class DeleteEmojiHandler
{
    /**
     * @param  DeleteEmoji $command
     * @return Emoji
     */
    public function handle(DeleteEmoji $command)
    {
        $emoji = Emoji::findOrFail($command->tagId);

        $emoji->delete();

        return $emoji;
    }
}
