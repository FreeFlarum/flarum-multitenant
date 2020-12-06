<?php

/*
 * This file is part of askvortsov/flarum-moderator-warnings
 *
 *  Copyright (c) 2020 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Askvortsov\FlarumWarnings;

use Askvortsov\FlarumWarnings\Access\UserPolicy;
use Askvortsov\FlarumWarnings\Api\Controller;
use Askvortsov\FlarumWarnings\Api\Serializer\WarningSerializer;
use Askvortsov\FlarumWarnings\Model\Warning;
use Askvortsov\FlarumWarnings\Notification\WarningBlueprint;
use Flarum\Event\ConfigureNotificationTypes;
use Flarum\Extend;
use Flarum\Formatter\Formatter;
use Flarum\Post\Post;
use Illuminate\Contracts\Events\Dispatcher;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),

    new Extend\Locales(__DIR__.'/resources/locale'),

    (new Extend\Routes('api'))
        ->get('/warnings/{user_id}', 'warnings.index', Controller\ListWarningsController::class)
        ->patch('/warnings/{warning_id}', 'warnings.update', Controller\UpdateWarningController::class)
        ->delete('/warnings/{warning_id}', 'warnings.delete', Controller\DeleteWarningController::class)
        ->post('/warnings', 'warnings.create', Controller\CreateWarningController::class),

    (new Extend\Model(Post::class))
        ->hasMany('warnings', Warning::class, 'post_id'),

    (new Extend\View())->namespace('askvortsov-moderator-warnings', __DIR__ . '/views'),

    function (Dispatcher $events) {
        $events->subscribe(Listeners\AddPermissionsToUserSerializer::class);
        $events->subscribe(Listeners\AddPostWarningRelationship::class);
        $events->subscribe(UserPolicy::class);

        $events->listen(ConfigureNotificationTypes::class, function (ConfigureNotificationTypes $event) {
            $event->add(WarningBlueprint::class, WarningSerializer::class, ['alert', 'email']);
        });
    },

    function (Formatter $formatter) {
        Warning::setFormatter($formatter);
    },
];
