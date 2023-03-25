<?php

namespace Nearata\MinecraftAvatars;

use Flarum\Foundation\ValidationException;
use Flarum\User\Event\Saving;

use Illuminate\Support\Arr;

use Nearata\MinecraftAvatars\Helpers;
use Symfony\Contracts\Translation\TranslatorInterface;

class SaveMinecraftAvatar
{
    protected $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function handle(Saving $event): void
    {
        if (!Arr::has($event->data, 'attributes.minotar')) {
            return;
        }

        $minotar = Arr::get($event->data, 'attributes.minotar');

        $uuid = null;

        if (Helpers::isUsername($minotar)) {
            $uuid = Helpers::getUUID($minotar);

            if (empty($uuid)) {
                throw new ValidationException([
                    'nearataMinecraftAvatars' => $this->translator->trans('nearata-minecraft-avatars.forum.username_not_found')
                ]);
            }
        } else if (Helpers::isUUID($minotar)) {
            $uuid = $minotar;
        } else if (strlen($minotar) === 0) {
            $uuid = Helpers::getRandomUsername();
        } else {
            throw new ValidationException([
                'nearataMinecraftAvatars' => $this->translator->trans('nearata-minecraft-avatars.forum.username_uuid_not_valid')
            ]);
        }

        $event->user->minotar = $uuid;
    }
}
