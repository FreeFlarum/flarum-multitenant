<?php

namespace Nearata\MinecraftAvatars;

use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\Event\Registered;

class RegisteredListener
{
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function handle(Registered $event): void
    {
        if (!$this->settings->get("nearata-minecraft-avatars.retrieve_avatar_on_register")) {
            return;
        }

        $minotar = Helpers::getUUID($event->user->username);

        if (empty($minotar)) {
            $minotar = Helpers::getRandomUsername();
        }

        $event->user->minotar = $minotar;
        $event->user->save();
    }
}
