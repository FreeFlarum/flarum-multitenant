<?php

namespace Justoverclock\UsersMapLocation\Listeners;

use Flarum\User\Event\Saving;
use Illuminate\Support\Arr;

class SaveLocationToDatabase
{
    public function handle(Saving $event)
    {
        $user = $event->user;
        $data = $event->data;
        $actor = $event->actor;

        $isSelf = $actor->id === $user->id;
        $canEdit = $actor->can('edit', $user);
        $attributes = Arr::get($data, 'attributes', []);

        if (isset($attributes['location'])) {
            if (!$isSelf) {
                $actor->assertPermission($canEdit);
            }
            $user->location = $attributes['location'];
        }
    }
}
