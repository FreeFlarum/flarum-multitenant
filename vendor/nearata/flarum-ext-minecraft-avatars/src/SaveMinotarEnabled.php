<?php

namespace Nearata\MinecraftAvatars;

use Flarum\User\Event\Saving;

use Illuminate\Support\Arr;

class SaveMinotarEnabled
{
    public function __construct()
    {
    }

    public function handle(Saving $event): void
    {
        if (!Arr::has($event->data, 'attributes.minotarEnabled')) {
            return;
        }

        $enabled = Arr::get($event->data, 'attributes.minotarEnabled');

        if (!is_bool($enabled)) {
            return;
        }

        $event->user->minotar_enabled = $enabled;
    }
}
