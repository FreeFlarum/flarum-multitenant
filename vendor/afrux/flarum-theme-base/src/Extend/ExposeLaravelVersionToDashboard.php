<?php

namespace Afrux\ThemeBase\Extend;

use Flarum\Extend;
use Flarum\Extension\Extension;
use Flarum\Frontend\Document;
use Illuminate\Contracts\Container\Container;

class ExposeLaravelVersionToDashboard implements Extend\ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        (new Extend\Frontend('admin'))
            ->content(function (Document $document) {
                $paths = resolve(\Flarum\Foundation\Paths::class);
                $filesystem = resolve(\Illuminate\Filesystem\Filesystem::class);
                $settings = resolve('flarum.settings');

                if ($filesystem->exists($paths->vendor.'/composer/installed.json')) {
                    $lastComposerUpdate = $filesystem->lastModified($paths->vendor.'/composer/installed.json');
                    $savedVersion = $settings->get('afrux-theme-base.illuminateVersion', null);

                    if (! $savedVersion) {
                        $savedVersion = [
                            'value' => '',
                            'lastComposerUpdate' => 0,
                        ];
                    } else {
                        $savedVersion = json_decode($savedVersion, true);
                    }

                    $value = $savedVersion['value'];

                    if ($lastComposerUpdate > $savedVersion['lastComposerUpdate']) {
                        $installed = json_decode($filesystem->get($paths->vendor.'/composer/installed.json'), true);
                        $installed = $installed['packages'] ?? $installed;

                        $packages = array_filter($installed, function ($package) {
                            return $package['name'] === 'illuminate/container';
                        });

                        $illuminate = end($packages);

                        if (! empty($illuminate)) {
                            $value = $illuminate['version'];

                            $settings->set('afrux-theme-base.illuminateVersion', json_encode(compact('value', 'lastComposerUpdate')));
                        }
                    }

                    if (! empty($value)) {
                        $document->payload['illuminateVersion'] = $value;
                    }
                }
            })
            ->extend($container, $extension);
    }
}
