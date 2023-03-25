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
        return [
            'embedVideoCreate' => (bool) $serializer->getActor()->can('nearata.embedvideo.create'),
            'embedVideoDash' => (bool) $this->settings->get('nearata-embed-video.admin.settings.video_type.dash'),
            'embedVideoFlv' => (bool) $this->settings->get('nearata-embed-video.admin.settings.video_type.flv'),
            'embedVideoHls' => (bool) $this->settings->get('nearata-embed-video.admin.settings.video_type.hls'),
            'embedVideoShaka' => (bool) $this->settings->get('nearata-embed-video.admin.settings.video_type.shaka'),
            'embedVideoWebTorrent' => (bool) $this->settings->get('nearata-embed-video.admin.settings.video_type.webtorrent'),
            'embedVideoAirplay' => (bool) $this->settings->get('nearata-embed-video.admin.settings.options.airplay'),
            'embedVideoHotkey' => (bool) $this->settings->get('nearata-embed-video.admin.settings.options.hotkey'),
            'embedVideoQualitySwitching' => (bool) $this->settings->get('nearata-embed-video.admin.settings.options.quality_switching'),
            'embedVideoTheme' => (string) $this->settings->get('nearata-embed-video.admin.settings.options.theme'),
            'embedVideoLogo' => (string) $this->settings->get('nearata-embed-video.admin.settings.options.logo'),
            'embedVideoLang' => (string) $this->settings->get('nearata-embed-video.admin.settings.options.lang'),
            'embedVideoModal' => (bool) $this->settings->get('nearata-embed-video.admin.settings.options.modal_enabled')
        ];
    }
}
