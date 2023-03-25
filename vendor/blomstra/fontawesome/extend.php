<?php

/*
 * This file is part of blomstra/fontawesome.
 *
 *  Copyright (c) 2022 Blomstra Ltd.
 *
 *  For the full copyright and license information, please view the LICENSE.md
 *  file that was distributed with this source code.
 *
 */

namespace Blomstra\FontAwesome;

use Blomstra\FontAwesome\Content\Frontend;
use Blomstra\FontAwesome\Providers\FontAwesomeLessImports;
use Blomstra\FontAwesome\Providers\FontAwesomePreloads;
use Flarum\Extend;
use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Filesystem\Factory;

return [
    (new Extend\Frontend('forum'))
        ->css(__DIR__.'/less/forum.less')
        ->css(__DIR__.'/less/common.less')
        ->content(Frontend::class),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less')
        ->css(__DIR__.'/less/common.less')
        ->content(Frontend::class),

    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\ServiceProvider())
        ->register(FontAwesomePreloads::class)
        ->register(FontAwesomeLessImports::class),

    (new Extend\Settings())
        ->default('blomstra-fontawesome.kitUrl', '')
        ->default('blomstra-fontawesome.type', 'free'),

    (new Extend\Theme())
        ->addCustomLessFunction('blomstra-fontawesome-font-urls', function ($style) {
            /**
             * @var Cloud
             */
            $disk = resolve(Factory::class)->disk('flarum-assets');
            $uri = $disk->url('extensions/blomstra-fontawesome/fontawesome-6-free/fa-'.$style);

            if ($style === 'solid') {
                $uri .= '-900';
            } else {
                $uri .= '-400';
            }

            return "url('$uri.woff2') format('woff2'), url('$uri.ttf') format('truetype')";
        })
];
