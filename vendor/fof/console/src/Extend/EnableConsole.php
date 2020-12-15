<?php

namespace FoF\Console\Extend;

use FoF\Console\Providers\ConsoleProvider;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Flarum\Foundation\Application;
use Illuminate\Contracts\Container\Container;

class EnableConsole implements ExtenderInterface
{
    static $instantiated = false;

    public function extend(Container $container, Extension $extension = null)
    {
        if (! static::$instantiated) {
            require_once __DIR__ . '/../helpers.php';

            $container->make(Application::class)->register(ConsoleProvider::class);

            static::$instantiated = true;
        }
    }
}
