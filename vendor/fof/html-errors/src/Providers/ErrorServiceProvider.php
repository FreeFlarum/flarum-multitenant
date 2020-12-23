<?php

namespace FoF\HtmlErrors\Providers;

use Flarum\Foundation\ErrorHandling\ViewFormatter;
use FoF\HtmlErrors\ErrorHandling\CustomViewFormatter;
use Illuminate\Support\ServiceProvider;

class ErrorServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Replace Flarum's error view formatter with our own
        $this->app->bind(ViewFormatter::class, CustomViewFormatter::class);
    }
}
