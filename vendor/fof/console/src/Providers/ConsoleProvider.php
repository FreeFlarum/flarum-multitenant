<?php

namespace FoF\Console\Providers;

use FoF\Console\Cache\Factory;
use Illuminate\Console\Scheduling\ScheduleRunCommand;
use Flarum\Foundation\AbstractServiceProvider;
use FoF\Console\Overrides\CustomSchedule;
use Illuminate\Console\Scheduling\CacheEventMutex;
use Illuminate\Console\Scheduling\CacheSchedulingMutex;
use Illuminate\Console\Scheduling\EventMutex;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Console\Scheduling\SchedulingMutex;

class ConsoleProvider extends AbstractServiceProvider
{
    public function register()
    {
        // Used by Laravel to proxy artisan commands to its binary.
        // Flarum uses a similar binary, but it's called flarum.
        if (! defined('ARTISAN_BINARY')) define('ARTISAN_BINARY', 'flarum');

        $this->app->singleton(Schedule::class);
        $this->app->singleton(Factory::class);

        $this->app->bind(EventMutex::class, function ($app) {
            return new CacheEventMutex($app->make(Factory::class));
        });

        $this->app->bind(SchedulingMutex::class, function ($app) {
            return new CacheSchedulingMutex($app->make(Factory::class));
        });

        $this->app->singleton(Schedule::class, function($current) {
            return $this->app->make(CustomSchedule::class);
        });

        $this->app->extend('flarum.console.commands', function ($existingCommands) {
            return array_merge($existingCommands, [ScheduleRunCommand::class]);
        });
    }
}
