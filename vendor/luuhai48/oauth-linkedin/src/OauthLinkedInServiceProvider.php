<?php

/*
 * This file is part of luuhai48/oauth-likedin.
 *
 * Copyright (c) 2020 Luuhai48.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Luuhai48\OauthLinkedIn;

use Illuminate\Support\ServiceProvider;


class OauthLinkedInServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->tag([
            Providers\LinkedIn::class,
        ], 'fof-oauth.providers');
    }
}