<?php

namespace ImgurUpload\Listeners;

use Flarum\Api\Event\Serializing;
use Flarum\Api\Serializer\ForumSerializer;
use Illuminate\Contracts\Events\Dispatcher;
use Flarum\Settings\SettingsRepositoryInterface;

class LoadSettingsFromDatabase
{
    protected $addSettings = [
        'client-id'
    ];

    /**
     * Subscribes to the Flarum events.
     *
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(Serializing::class, [$this, 'prepareApiAttributes']);
    }

    /**
     * Get the setting values from the database and make them available
     * in the forum.
     *
     * @param Serializing $event
     */
    public function prepareApiAttributes(Serializing $event)
    {
        if ($event->isSerializer(ForumSerializer::class)) {
            $settings = app(SettingsRepositoryInterface::class);

            foreach ($this->addSettings as $key) {
                $event->attributes[$this->prefix($key)] = $settings->get($this->prefix($key));
            }
        }
    }

    protected function prefix($key)
    {
        return "imgur-upload.$key";
    }
}
