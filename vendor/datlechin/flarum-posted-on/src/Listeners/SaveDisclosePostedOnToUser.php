<?php

namespace Datlechin\PostedOn\Listeners;

use Flarum\User\Event\Saving;
use Illuminate\Support\Arr;

class SaveDisclosePostedOnToUser
{
    public function handle(Saving $event)
    {
        $user = $event->user;
        $data = $event->data;
        $attributes = Arr::get($data, 'attributes', []);

        if (isset($attributes['disclosePostedOn'])) $user->disclose_posted_on = $attributes['disclosePostedOn'];
    }
}
