<?php

namespace Afrux\ThemeBase\Extend;

use Afrux\ThemeBase\Api\Controller\UploadHeroImageController;
use Afrux\ThemeBase\Api\Controller\DeleteHeroImageController;
use Flarum\Api\Serializer\ForumSerializer;
use Afrux\ThemeBase\AddHeroImageUrlToApi;
use Flarum\Extend;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

class UploadableBanner implements Extend\ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        (new Extend\Routes('api'))
            ->post('/afrux_banner', 'afrux-theme-base.banner.upload', UploadHeroImageController::class)
            ->delete('/afrux_banner', 'afrux-theme-base.banner.remove', DeleteHeroImageController::class)
            ->extend($container, $extension);

        (new Extend\Settings)
            ->serializeToForum('afruxHeroBanner', 'afrux-theme-base.welcome_hero_banner', AddHeroImageUrlToApi::class)
            ->serializeToForum('afruxHeroBannerPosition', 'afrux-theme-base.hero_banner_position')
            ->extend($container, $extension);

        (new Extend\ApiSerializer(ForumSerializer::class))
            ->attribute('afrux-theme-base.bannerHooked', function () {
                return true;
            })
            ->extend($container, $extension);
    }
}
