<?php

namespace ClarkWinkelmann\CatchTheFish\Providers;

use ClarkWinkelmann\CatchTheFish\Repositories\FishImageUploader;
use Flarum\Foundation\AbstractServiceProvider;
use Flarum\Foundation\Paths;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemInterface;

class StorageServiceProvider extends AbstractServiceProvider
{
    public function register()
    {
        $this->container->bind('catchthefish-assets', function () {
            return new Filesystem(new Local($this->container->make(Paths::class)->public . '/assets/catch-the-fish'));
        });

        $this->container->when(FishImageUploader::class)
            ->needs(FilesystemInterface::class)
            ->give('catchthefish-assets');
    }
}
