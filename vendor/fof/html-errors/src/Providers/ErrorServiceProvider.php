<?php

namespace FoF\HtmlErrors\Providers;

use Flarum\Foundation\AbstractServiceProvider;
use Flarum\Foundation\ErrorHandling\ViewFormatter;
use FoF\HtmlErrors\ErrorHandling\CustomViewFormatter;

class ErrorServiceProvider extends AbstractServiceProvider
{
    public function register()
    {
        // Replace Flarum's error view formatter with our own
        $this->container->bind(ViewFormatter::class, CustomViewFormatter::class);
    }
}
