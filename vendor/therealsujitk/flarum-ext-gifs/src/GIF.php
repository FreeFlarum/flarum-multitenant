<?php

namespace Therealsujitk\GIFs;

use Flarum\Database\AbstractModel;
use Flarum\User\User;

/**
 * @property int $id
 * @property int $user_id
 * @property string $gif_id
 */
class GIF extends AbstractModel {
    protected $table = 'therealsujitk_gifs';

    public function user() {
        return $this->belongsTo(User::class);
    }
}
