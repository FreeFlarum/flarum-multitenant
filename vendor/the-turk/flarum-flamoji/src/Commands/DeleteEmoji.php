<?php

namespace TheTurk\Flamoji\Commands;

class DeleteEmoji
{
    /**
     * The ID of the emoji to delete.
     *
     * @var int
     */
    public $emojiId;

    /**
     * @param int $tagId The ID of the emoji to delete.
     */
    public function __construct($tagId)
    {
        $this->tagId = $tagId;
    }
}
