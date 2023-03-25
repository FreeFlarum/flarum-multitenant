<?php

namespace Afrux\ThemeBase\Extend;

use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Extend;
use Flarum\Extension\Extension;
use Flarum\Frontend\Document;
use Illuminate\Contracts\Container\Container;

class Footer implements Extend\ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        (new Extend\Frontend('forum'))
            ->content(function (Document $document) {
                $document->layoutView = "afrux-theme-base::frontend.forum";
            })
            ->extend($container, $extension);

        (new Extend\Settings)
            ->serializeToForum('afrux-theme-base.footerDescription', 'afrux-theme-base.footer_description')
            ->serializeToForum('afrux-theme-base.footerBottomLine', 'afrux-theme-base.footer_bottom_line')
            ->serializeToForum('afrux-theme-base.footerLinks', 'afrux-theme-base.footer_links', function (?string $value) {
                return empty($value) ? [] : json_decode($value, true);
            })
            ->extend($container, $extension);

        (new Extend\ApiSerializer(ForumSerializer::class))
            ->attribute('afrux-theme-base.footerHooked', function () {
                return true;
            })
            ->extend($container, $extension);
    }
}
