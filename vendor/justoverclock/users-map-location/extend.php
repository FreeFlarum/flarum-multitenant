<?php

/*
 * This file is part of justoverclock/users-map-location.
 *
 * Copyright (c) 2022 Marco Colia.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Justoverclock\UsersMapLocation;


use Justoverclock\UsersMapLocation\Listeners\SaveLocationToDatabase;
use Justoverclock\UsersMapLocation\Listeners\AddLocationAttribute;
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Extend;
use Flarum\User\Event\Saving;
use Flarum\Api\Event\Serializing;


return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less'),
    new Extend\Locales(__DIR__.'/locale'),
    (new Extend\Event())
        ->listen(Saving::class, SaveLocationToDatabase::class),

    (new Extend\ApiSerializer(UserSerializer::class))
        ->attributes(AddLocationAttribute::class),

    (new Extend\Settings)->serializeToForum('justoverclock-users-map-location.mapBox-api-key', 'justoverclock-users-map-location.mapBox-api-key'),
];
