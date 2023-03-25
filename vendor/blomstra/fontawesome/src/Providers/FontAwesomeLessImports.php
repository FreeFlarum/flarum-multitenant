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

namespace Blomstra\FontAwesome\Providers;

use Flarum\Foundation\AbstractServiceProvider;
use Flarum\Foundation\Paths;
use Flarum\Frontend\Assets;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Container\Container;

class FontAwesomeLessImports extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->container->extend('flarum.assets.factory', function (callable $factory, Container $container) {
            return function (...$args) use ($factory, $container) {
                /** @var Assets $assets */
                $assets = $factory(...$args);

                /** @var SettingsRepositoryInterface $settings */
                $settings = $container[SettingsRepositoryInterface::class];

                /** @var Paths $paths */
                $paths = $container[Paths::class];

                $type = $settings->get('blomstra-fontawesome.type');

                if ($type === 'kit') {
                    $fontawesomeStubPath = $paths->vendor.'/blomstra/fontawesome/fontawesome-6-kit-stub/less';
                } elseif ($type === 'free') {
                    $fontawesomeStubPath = $paths->vendor.'/blomstra/fontawesome/fontawesome-6-free/less';
                } else {
                    return $assets;
                }

                $assets->setLessImportDirs([
                    $fontawesomeStubPath => '',
                ]);

                return $assets;
            };
        });
    }
}
