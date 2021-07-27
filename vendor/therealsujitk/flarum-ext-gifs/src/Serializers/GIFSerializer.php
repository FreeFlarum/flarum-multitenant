<?php

namespace Therealsujitk\GIFs\Serializers;

use Therealsujitk\GIFs\GIF;
use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Api\Serializer\BasicUserSerializer;

class GIFSerializer extends AbstractSerializer {
    protected $type = 'therealsujitk-gifs';

    /**
     * @param GIF $gif
     * @return array
     */
    protected function getDefaultAttributes($gif) {
        return [
            'gifID' => $gif->gif_id
        ];
    }

    public function user($gif) {
        return $this->belongsTo($gif, BasicUserSerializer::class);
    }
}
