<?php

namespace Dem13n\NickName\Changer\Listener;

use Illuminate\Contracts\Events\Dispatcher;
use Flarum\User\Event\GetDisplayName;

class ChangeDisplayNameAttribute
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(GetDisplayName::class, function ($user) {
            $display_name = $user->user->findOrFail($user->user->id)->nickname;
            return $display_name;
        });
    }
}
