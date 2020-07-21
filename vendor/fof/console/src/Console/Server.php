<?php

namespace FoF\Console\Console;

use FoF\Console\Events\ConfigureConsoleApplication;
use Flarum\Console\Server as AbstractServer;
use Illuminate\Console\Application;
use Illuminate\Contracts\Events\Dispatcher;

/**
 * Console server for Flagrow
 * Based on Flarum\Console\Server
 */
class Server extends AbstractServer
{
    /**
     * @return Application
     */
    protected function getConsoleApplication()
    {
        $events = $this->app->make(Dispatcher::class);

        $console = new Application($this->app, $events, $this->app->version());
        $console->setName('Flagrow Console');

        $events->fire(new ConfigureConsoleApplication($this->app, $console));

        return $console;
    }
}
