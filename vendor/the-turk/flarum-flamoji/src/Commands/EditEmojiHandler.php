<?php

namespace TheTurk\Flamoji\Commands;

use TheTurk\Flamoji\Models\Emoji;
use Illuminate\Support\Arr;

class EditEmojiHandler
{
    /**
     * @param  EditEmoji $command
     * @return Emoji
     */
    public function handle(EditEmoji $command)
    {
        $data = $command->data;

        $emoji = Emoji::findOrFail($command->emojiId);

        $attributes = Arr::get($data, 'attributes', []);

        if (isset($attributes['title'])) {
            $emoji->title = $attributes['title'];
        }

        if (isset($attributes['textToReplace'])) {
            $emoji->text_to_replace = $attributes['textToReplace'];
        }

        if (isset($attributes['path'])) {
            $emoji->path = $attributes['path'];
        }

        $emoji->save();

        return $emoji;
    }
}
