<?php

/*
 * This file is part of fof/stopforumspam.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\StopForumSpam;

use Flarum\Extend;
use Flarum\User\Event\RegisteringFromProvider;
use FoF\Spamblock\Event\MarkedUserAsSpammer;
use FoF\StopForumSpam\Middleware\RegisterMiddleware;

return[
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),

    (new Extend\Locales(__DIR__.'/resources/locale')),

    (new Extend\Event())
        ->listen(MarkedUserAsSpammer::class, Listeners\ReportSpammer::class)
        ->listen(RegisteringFromProvider::class, Listeners\ProviderRegistration::class),

    (new Extend\Middleware('forum'))
        ->add(RegisterMiddleware::class),
];
