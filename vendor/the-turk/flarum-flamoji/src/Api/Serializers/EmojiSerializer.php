<?php

namespace TheTurk\Flamoji\Api\Serializers;

use Flarum\Api\Serializer\AbstractSerializer;
use TheTurk\Flamoji\Emoji;

class EmojiSerializer extends AbstractSerializer
{
    protected $type = 'emojis';

    /**
     * Get the default set of serialized attributes for a model.
     *
     * @param Emoji $model
     *
     * @return array
     */
    protected function getDefaultAttributes($model)
    {
        return [
            'title'            => $model->title,
            'text_to_replace'  => $model->text_to_replace,
            'path'             => $model->path
        ];
    }
}
