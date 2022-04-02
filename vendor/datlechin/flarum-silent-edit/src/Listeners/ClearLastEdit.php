<?php

namespace Datlechin\SilentEdit\Listeners;

use Flarum\Post\Event\Saving;

class ClearLastEdit
{
    public function handle(Saving $event)
    {
        $attributes = $event->data['attributes'];
        $post = $event->post;

        if (isset($attributes['isEdited'])) {
            $post->edited_at = null;
            $post->edited_user_id = null;
            $post->save();
        }
    }
}
