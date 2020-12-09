<?php

/*
 * This file is part of fof/filter.
 *
 * Copyright (c) 2020 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 */

namespace FoF\Filter;

use Flarum\Extend;
use Flarum\Post\Event\Posted;
use Flarum\Post\Event\Saving as PostSaving;
use Flarum\Settings\Event\Saving as SettingSaving;
use FoF\Filter\Listener\AddCensorChecks;
use FoF\Filter\Listener\AutoMerge;
use FoF\Filter\Listener\CheckPost;

return [
    (new Extend\Frontend('admin'))
        ->css(__DIR__.'/resources/less/admin/WordConfigPage.less')
        ->js(__DIR__.'/js/dist/admin.js'),

    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js'),

    new Extend\Locales(__DIR__.'/resources/locale'),

    (new Extend\View())
        ->namespace('fof-filter', __DIR__.'/views'),

    (new Extend\Event())
        ->listen(SettingSaving::class, AddCensorChecks::class)
        ->listen(PostSaving::class, CheckPost::class)
        ->listen(Posted::class, AutoMerge::class),
];
