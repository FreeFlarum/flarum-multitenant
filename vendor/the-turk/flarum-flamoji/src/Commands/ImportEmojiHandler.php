<?php

namespace TheTurk\Flamoji\Commands;

use TheTurk\Flamoji\Models\Emoji;
use Illuminate\Support\Arr;

class ImportEmojiHandler
{
    /**
     * @param  ImportEmoji $command
     * @return Emoji
     */
    public function handle(ImportEmoji $command)
    {
        $data = $command->data;
        $emoji = null;
        
        foreach ($data as $emojiData) {
            $emoji = Emoji::build(
                Arr::get($emojiData, 'title'),
                Arr::get($emojiData, 'text_to_replace'),
                Arr::get($emojiData, 'path')
            );
    
            $emoji->save();
        }

        return $emoji;
    }
}
