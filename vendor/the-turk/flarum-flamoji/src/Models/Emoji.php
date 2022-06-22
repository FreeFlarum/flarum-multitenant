<?php

namespace TheTurk\Flamoji\Models;

use Flarum\Database\AbstractModel;

/**
 * @property int         $id
 * @property string|null $title
 * @property string|null $text_to_replace
 * @property string      $path
 */
class Emoji extends AbstractModel
{
    protected $table = 'custom_emojis';

    /**
     * Create a new emoji.
     *
     * @param  string $title
     * @param  string $textToReplace
     * @param  string $path
     * @return static
     */
    public static function build($title, $textToReplace, $path)
    {
        $emoji = new static;

        $emoji->title = $title;
        $emoji->text_to_replace = $textToReplace;
        $emoji->path = $path;

        return $emoji;
    }
}
