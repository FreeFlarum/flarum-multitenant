<?php

namespace FoF\Console\Providers;

use FoF\Console\Cache\Factory;
use FoF\Console\Listeners\ConfigureConsole;
use Flarum\Foundation\AbstractServiceProvider;
use Illuminate\Console\Scheduling\CacheEventMutex;
use Illuminate\Console\Scheduling\CacheSchedulingMutex;
use Illuminate\Console\Scheduling\EventMutex;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Console\Scheduling\SchedulingMutex;

class ConsoleProvider extends AbstractServiceProvider
{
    public function register()
    {
        $this->app->singleton(Schedule::class);
        $this->app->singleton(Factory::class);

        $this->app->bind(EventMutex::class, function ($app) {
            return new CacheEventMutex($app->make(Factory::class));
        });

        $this->app->bind(SchedulingMutex::class, function ($app) {
            return new CacheSchedulingMutex($app->make(Factory::class));
        });

        $this->app->make('events')->subscribe(ConfigureConsole::class);
    }

    public function provides()
    {
        return [Schedule::class];
    }
}
