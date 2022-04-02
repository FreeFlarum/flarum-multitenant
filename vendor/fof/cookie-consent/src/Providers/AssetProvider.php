<?php

/*
 * This file is part of fof/cookie-consent.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\CookieConsent\Providers;

use Flarum\Foundation\AbstractServiceProvider;
use Flarum\Frontend\Assets;
use Flarum\Frontend\Compiler\Source\SourceCollector;

class AssetProvider extends AbstractServiceProvider
{
    public function boot()
    {
        $this->container->resolving('flarum.assets.forum', function (Assets $assets) {
            if (resolve('flarum.settings')->get('reflar-cookie-consent.ccTheme') != 'no_css') {
                $assets->css(function (SourceCollector $sources) {
                    $sources->addFile(__DIR__.'/../../resources/less/forum.less');
                });
            }
        });
    }
}
