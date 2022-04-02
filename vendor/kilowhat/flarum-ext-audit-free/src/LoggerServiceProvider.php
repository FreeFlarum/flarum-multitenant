<?php

namespace Kilowhat\Audit;

use Flarum\Foundation\AbstractServiceProvider;

class LoggerServiceProvider extends AbstractServiceProvider
{
    public function register()
    {
        $this->container->extend('flarum.api_client.exclude_middleware', function (array $middlewares): array {
            $middlewares[] = Middlewares\SetLoggerActor::class;

            return $middlewares;
        });
    }
}
