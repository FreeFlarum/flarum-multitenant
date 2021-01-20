<?php

namespace Therealsujitk\GIFs\Listeners;

use Flarum\Api\Event\Serializing;
use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Settings\SettingsRepositoryInterface;

class SaveSettings
{
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings) {
        $this->settings = $settings;
    }

    public function handle(Serializing $event) {
        if ($event->isSerializer(ForumSerializer::class)) {
            $event->attributes['therealsujitk-gifs.giphy_api_key'] = $this->settings->get('therealsujitk-gifs.giphy_api_key');
        }
    }
}
