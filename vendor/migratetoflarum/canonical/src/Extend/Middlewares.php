<?php

namespace MigrateToFlarum\Canonical\Extend;

use Flarum\Event\ConfigureMiddleware;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;
use MigrateToFlarum\Canonical\Middlewares\CanonicalRedirectMiddleware;

class Middlewares implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        $container['events']->listen(ConfigureMiddleware::class, [$this, 'configure']);
    }

    public function configure(ConfigureMiddleware $event)
    {
        $event->pipe->pipe(app(CanonicalRedirectMiddleware::class));
    }
}
