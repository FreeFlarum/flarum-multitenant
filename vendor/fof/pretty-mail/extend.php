<?php

/*
 * This file is part of reflar/pretty-mail.
 *
 * Copyright (c) ReFlar.
 *
 * https://reflar.redevs.org
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\PrettyMail;

use Flarum\Extend as Native;
use Flarum\Foundation\Application;

return [
    (new Native\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),
    new Native\Locales(__DIR__.'/resources/locale'),
    function (Application $app) {
        $app->register(Providers\MailerProvider::class);
    },
];
