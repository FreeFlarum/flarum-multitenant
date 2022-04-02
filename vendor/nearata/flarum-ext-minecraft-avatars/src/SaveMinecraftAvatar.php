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

    public function handle(Saving $event)
    {
        if (!Arr::has($event->data, 'attributes.minotar')) {
            return;
        }

        $minotar = Arr::get($event->data, 'attributes.minotar');

        $validUUIDPlainRegex = '[0-9a-f]{32}';
        $validUUIDDashRegex = '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}';
        $validUUIDRegex = '/^(' . $validUUIDPlainRegex . '|' . $validUUIDDashRegex . ')$/';

        $uuid = null;

        if (Helpers::isUsername($minotar)) {
            $uuid = Helpers::getUUID($minotar);

            if (empty($uuid)) {
                throw new ValidationException([
                    'nearataMinecraftAvatars' => $this->translator->trans('nearata-minecraft-avatars.forum.username_not_found')
                ]);
            }
        } else if (preg_match($validUUIDRegex, $minotar)) {
            $uuid = $minotar;
        } else if (strlen($minotar) === 0) {
            $uuid = null;
        } else {
            throw new ValidationException([
                'nearataMinecraftAvatars' => $this->translator->trans('nearata-minecraft-avatars.forum.username_uuid_not_valid')
            ]);
        }

        $event->user->minotar = $uuid;
    }
}
