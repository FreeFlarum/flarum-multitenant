<?php

namespace Dem13n\NickName\Changer\Listener;

use Illuminate\Contracts\Events\Dispatcher;
use Flarum\Api\Event\Serializing;
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Settings\SettingsRepositoryInterface;

class AddAttributes
{
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(Serializing::class, [$this, 'canPermanentNicknameChange']);
        $events->listen(Serializing::class, [$this, 'NicknameChangeSettings']);
    }

    public function canPermanentNicknameChange(Serializing $event)
    {
        if ($event->isSerializer(UserSerializer::class)) {
            $event->attributes['canPermanentNicknameChange'] = (bool)$event->actor->can('dem13n.canPermanentNicknameChange');
        }
    }

    public function NicknameChangeSettings(Serializing $event)
    {
        if ($event->isSerializer(ForumSerializer::class)) {
            $event->attributes['NicknameChange'] = $this->settings->get('dem13n_nickname_change');
        }
    }
}
