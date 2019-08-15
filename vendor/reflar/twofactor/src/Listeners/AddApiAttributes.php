<?php

namespace Reflar\twofactor\Listeners;

use Flarum\Api\Event\Serializing;
use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;

class AddApiAttributes
{
    /**
     * @param SettingsRepositoryInterface $settings
     */
    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(Serializing::class, [$this, 'addForumAttributes']);
    }

    /**
     * @param Serializing $event
     */
    public function addForumAttributes(Serializing $event)
    {
        if ($event->isSerializer(UserSerializer::class)) {
            if ($event->actor->id === $event->model->id) {
                $event->attributes['twofa-enabled'] = $event->model->twofa_enabled;
            }
        }
        if ($event->isSerializer(ForumSerializer::class)) {
            $event->attributes['twillio_enabled'] = $this->settings->get('reflar.twofactor.twillio_enabled');
            $event->attributes['authy_enabled'] = $this->settings->get('reflar.twofactor.authy_enabled');
        }
    }
}
