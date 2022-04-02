<?php

namespace ClarkWinkelmann\PasswordLess\Listeners;

use Flarum\User\Event\Saving;
use Illuminate\Support\Str;

class SaveUser
{
    public function handle(Saving $event)
    {
        // If a user is being created and didn't set a password, we generate a random one so that the validation passes
        if (!$event->user->exists && !$event->user->password) {
            $event->user->password = Str::random(20);
        }
    }
}
