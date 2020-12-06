<?php

/*
 * This file is part of luuhai48/oauth-linkedin.
 *
 * Copyright (c) 2020 luuhai48.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Luuhai48\OauthLinkedIn;

use Flarum\Extend;
use Flarum\Foundation\Application;

return [
    (new Extend\Frontend('forum'))
        ->css(__DIR__ . '/resources/less/forum.less'),
    new Extend\Locales(__DIR__ . '/resources/locale'),
    function (Application $app) {
        $app->register(OauthLinkedInServiceProvider::class);
    }
];
