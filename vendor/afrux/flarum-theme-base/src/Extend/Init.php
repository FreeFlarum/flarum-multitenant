<?php

namespace Afrux\ThemeBase\Extend;

use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Extend;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

class Init implements Extend\ExtenderInterface
{
    private $currentThemeId;

    public function __construct(string $currentThemeId)
    {
        $this->currentThemeId = $currentThemeId;
    }

    public function extend(Container $container, Extension $extension = null)
    {
        (new Extend\Frontend('forum'))
            ->js(__DIR__.'/../../js/dist/forum.js')
            ->css(__DIR__.'/../../less/forum.less')
            ->extend($container, $extension);

        (new Extend\Frontend('admin'))
            ->js(__DIR__.'/../../js/dist/admin.js')
            ->css(__DIR__.'/../../less/admin.less')
            ->extend($container, $extension);

        (new Extend\Locales(__DIR__.'/../../locale'))
            ->extend($container, $extension);

        (new Extend\View)
            ->namespace("afrux-theme-base", __DIR__."/../../views")
            ->extend($container, $extension);

        (new Extend\ApiSerializer(ForumSerializer::class))
            ->attribute('currentThemeId', function () {
                return $this->currentThemeId;
            })
            ->extend($container, $extension);
    }
}
