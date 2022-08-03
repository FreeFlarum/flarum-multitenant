<?php

/*
 * This file is part of Stickiest.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace TheTurk\Stickiest\Provider;

use Flarum\Foundation\AbstractServiceProvider;
use Flarum\Sticky\PinStickiedDiscussionsToTop as StickyPin;
use TheTurk\Stickiest\PinStickiedDiscussionsToTop as StickiestPin;

class PinProvider extends AbstractServiceProvider
{
    public function register()
    {
        $this->container->bind(StickyPin::class, StickiestPin::class);
    }
}
