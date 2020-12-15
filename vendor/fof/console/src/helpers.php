<?php

use Flarum\Foundation\Paths;

if (! function_exists('base_path')) {
    function base_path(string $path = '') {
        /** @var Paths $paths */
        $paths = app(Paths::class);

        return $paths->base . $path;
    }
}
