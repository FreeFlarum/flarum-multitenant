<?php

namespace TheTurk\Flamoji\Commands;

class ImportEmoji
{
    /**
     * The attributes of the new emoji.
     *
     * @var array
     */
    public $data;

    /**
     * @param array $data The attributes of the new emoji.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}
