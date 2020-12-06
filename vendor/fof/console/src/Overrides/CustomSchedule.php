<?php

namespace FoF\Console\Overrides;

use Flarum\Foundation\Config;
use Illuminate\Container\Container;
use Illuminate\Console\Scheduling\Schedule;

class CustomSchedule extends Schedule
{
    public function dueEvents($app)
    {
        return collect($this->events)->filter->isDue(new FakeApp($app));
    }
}

class FakeApp
{
    public function __construct(Container $container)
    {
        $this->config = $container->make(Config::class);
    }

    public function isDownForMaintenance()
    {
        return $this->config->inMaintenanceMode();
    }

    public function environment()
    {
        return '';
    }
}
