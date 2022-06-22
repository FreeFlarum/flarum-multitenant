<?php

namespace TheTurk\Flamoji\Commands;

class EditEmoji
{
    /**
     * The ID of the emoji to edit.
     *
     * @var int
     */
    public $emojiId;

    /**
     * The attributes to update on the emoji.
     *
     * @var array
     */
    public $data;

    /**
     * @param int   $tagId The ID of the emoji to edit.
     * @param array $data  The attributes to update on the emoji.
     */
    public function __construct($emojiId, array $data)
    {
        $this->emojiId = $emojiId;
        $this->data = $data;
    }
}
