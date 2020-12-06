<?php

namespace FoF\Console\Extend;

use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Container\Container;

class ScheduleCommand implements ExtenderInterface
{
    /**
     * @var callable
     */
    protected $schedule;

    public function __construct($schedule)
    {
        $this->schedule = $schedule;
    }

    public function extend(Container $container, Extension $extension = null)
    {
        /** @var Schedule $schedule */
        $schedule = $container->make(Schedule::class);

        $callable = $this->schedule;

        $callable($schedule);
    }
}
