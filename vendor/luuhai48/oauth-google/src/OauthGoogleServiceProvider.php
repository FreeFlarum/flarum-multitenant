<?php

/*
 * This file is part of luuhai48/oauth-google.
 *
 * Copyright (c) 2020 Luuhai48.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Luuhai48\OauthGoogle;

use Illuminate\Support\ServiceProvider;


class OauthGoogleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->tag([
            Providers\Google::class,
        ], 'fof-oauth.providers');
    }
}
