<?php

/*
 * This file is part of askvortsov/flarum-moderator-warnings
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Askvortsov\FlarumWarnings\Provider;

use Askvortsov\FlarumWarnings\Model\Warning;
use Flarum\Formatter\Formatter;
use Flarum\Foundation\AbstractServiceProvider;

class WarningProvider extends AbstractServiceProvider
{
    public function register()
    {
        Warning::setFormatter($this->app->make(Formatter::class));
    }
}
