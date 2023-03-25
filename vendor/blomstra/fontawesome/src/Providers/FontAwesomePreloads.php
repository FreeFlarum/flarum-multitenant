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
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Filesystem\Factory;

class FontAwesomePreloads extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(SettingsRepositoryInterface $settings, Factory $filesystem)
    {
        /** @var Cloud $disk */
        $disk = $filesystem->disk('flarum-assets');

        $this->container->extend('flarum.frontend.default_preloads', function (array $preloads) use ($settings, $disk) {
            // Filter out FontAwesome preloads|
            $preloads = array_filter($preloads, function ($preload) {
                return ! str_contains($preload['href'], 'fonts/fa-');
            });

            $faType = $settings->get('blomstra-fontawesome.type');

            if ($faType === 'free') {
                $preloads[] = [
                    'href' => $disk->url('extensions/blomstra-fontawesome/fontawesome-6-free/fa-brands-400.woff2'),
                    'as' => 'font',
                    'type' => 'font/woff2',
                    'crossorigin' => ''
                ];
                $preloads[] = [
                    'href' => $disk->url('extensions/blomstra-fontawesome/fontawesome-6-free/fa-regular-400.woff2'),
                    'as' => 'font',
                    'type' => 'font/woff2',
                    'crossorigin' => ''
                ];
                $preloads[] = [
                    'href' => $disk->url('extensions/blomstra-fontawesome/fontawesome-6-free/fa-solid-900.woff2'),
                    'as' => 'font',
                    'type' => 'font/woff2',
                    'crossorigin' => ''
                ];
            } elseif ($faType === 'kit') {
                $preloads[] = [
                    'href' => $settings->get('blomstra-fontawesome.kitUrl'),
                    'as' => 'script',
                    'crossorigin' => 'anonymous'
                ];
            }

            return $preloads;
        });
    }
}
