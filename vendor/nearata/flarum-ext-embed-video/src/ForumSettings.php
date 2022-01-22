<?php

namespace Nearata\EmbedVideo;

use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Settings\SettingsRepositoryInterface;

class ForumSettings
{
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(ForumSerializer $serializer): array
    {
        $attributes = [];

        $attributes['embedVideoCreate'] = (bool) $serializer->getActor()->can('nearata.embedvideo.create');

        $attributes['embedVideoDash'] = (bool) $this->settings->get('nearata-embed-video.admin.settings.video_type.dash', false);
        $attributes['embedVideoFlv'] = (bool) $this->settings->get('nearata-embed-video.admin.settings.video_type.flv', false);
        $attributes['embedVideoHls'] = (bool) $this->settings->get('nearata-embed-video.admin.settings.video_type.hls', false);
        $attributes['embedVideoShaka'] = (bool) $this->settings->get('nearata-embed-video.admin.settings.video_type.shaka', false);
        $attributes['embedVideoWebTorrent'] = (bool) $this->settings->get('nearata-embed-video.admin.settings.video_type.webtorrent', false);
        $attributes['embedVideoAirplay'] = (bool) $this->settings->get('nearata-embed-video.admin.settings.options.airplay', false);
        $attributes['embedVideoHotkey'] = (bool) $this->settings->get('nearata-embed-video.admin.settings.options.hotkey', false);
        $attributes['embedVideoQualitySwitching'] = (bool) $this->settings->get('nearata-embed-video.admin.settings.options.quality_switching', false);
        $attributes['embedVideoTheme'] = (string) $this->settings->get('nearata-embed-video.admin.settings.options.theme', false);
        $attributes['embedVideoLogo'] = (string) $this->settings->get('nearata-embed-video.admin.settings.options.logo', false);
        $attributes['embedVideoLang'] = (string) $this->settings->get('nearata-embed-video.admin.settings.options.lang', false);

        return $attributes;
    }
}
