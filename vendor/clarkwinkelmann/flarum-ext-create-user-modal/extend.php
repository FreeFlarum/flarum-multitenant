<?php

namespace ClarkWinkelmann\CreateUserModal;

use Flarum\Api\Event\Serializing;
use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Extend;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    function (Dispatcher $events) {
        $events->listen(Serializing::class, function (Serializing $event) {
            if ($event->serializer instanceof ForumSerializer) {
                /**
                 * @var SettingsRepositoryInterface $settings
                 */
                $settings = app(SettingsRepositoryInterface::class);

                // We are using the core API endpoint for creating users,
                // which is accessible to anyone when signup is open, and accessible only to admins when signup is closed
                // We need to reflect whether the current user meets those criteria to show or hide the button
                $event->attributes['clarkwinkelmannCreateUserModal'] = $event->actor->isAdmin() || ($settings->get('allow_sign_up') && $event->actor->hasPermission('clarkwinkelmann.createUserModal'));
            }
        });
    }
];
