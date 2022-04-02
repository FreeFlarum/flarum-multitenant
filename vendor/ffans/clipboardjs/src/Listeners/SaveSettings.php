<?php

namespace FFans\ClipboardJS\Listeners;

use Flarum\Api\Serializer\UserSerializer;
use Flarum\Api\Event\Serializing;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;

class SaveSettings {
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings) {
        $this->settings = $settings;
    }

    public function subscribe(Dispatcher $events) {
        $events->listen(Serializing::class, [$this, 'addAttributes']);
    }

    public function addAttributes(Serializing $event) {
        $event->attributes['ffans-clipboardjs.theme_name'] = $this->settings->get('ffans-clipboardjs.theme_name');
        $event->attributes['ffans-clipboardjs.is_show_codeLang'] = $this->settings->get('ffans-clipboardjs.is_show_codeLang');
        $event->attributes['ffans-clipboardjs.is_copy_enable'] = $this->settings->get('ffans-clipboardjs.is_copy_enable');
    }
}
