<?php

/*
 * This file is part of fof/stopforumspam.
 *
 * Copyright (c) 2019 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\StopForumSpam;

use Flarum\Extend;
use FoF\Spamblock\Event\MarkedUserAsSpammer;
use FoF\StopForumSpam\Middleware\RegisterMiddleware;

return[
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    (new Extend\Locales(__DIR__.'/locale')),

    (new Extend\Event())
        ->listen(MarkedUserAsSpammer::class, Listeners\ReportSpammer::class),

    (new Extend\Middleware('forum'))->add(RegisterMiddleware::class),
];
