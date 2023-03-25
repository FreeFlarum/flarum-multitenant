<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
use Flarum\Extend;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\Settings\Event\Saving;
use Illuminate\Contracts\Container\Container;

$settings = app(SettingsRepositoryInterface::class);
$lang = $settings->get('flarumes.mode');
$mode = empty($lang) ? 'es-ES-informal' : $lang;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    (new Extend\Event)
        ->subscribe(SwitchLanguageEvent::class),

	(new Flarum\Extend\LanguagePack('/locale/' . $mode . '/'))
];

class SwitchLanguageEvent
{
    protected $settings;
    protected $container;

    public function __construct(SettingsRepositoryInterface $settings, Container $container)
    {
        $this->settings = $settings;
        $this->container = $container;
        $this->setLanguage($this->settings->get('flarumes.mode'));
    }

    public function subscribe($events)
    {
        $events->listen(Saving::class, [$this, 'handleSaving']);
    }

    public function handleSaving(Saving $event)
    {
        $this->setLanguage($this->settings->get('flarumes.mode'));
    }

    private function setLanguage($lang = null)
    {
        $mode = empty($lang) ? 'es-ES-informal' : $lang;
        new Flarum\Extend\LanguagePack('/locale/' . $mode . '/');
        $this->container->make('flarum.locales')->clearCache();
    }
}
