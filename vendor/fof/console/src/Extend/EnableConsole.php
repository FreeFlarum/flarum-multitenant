<?php

namespace FoF\Console\Extend;

use FoF\Console\Providers\ConsoleProvider;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Flarum\Foundation\Application;
use Illuminate\Contracts\Container\Container;

class EnableConsole implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        $container->make(Application::class)->register(ConsoleProvider::class);
    }
}
