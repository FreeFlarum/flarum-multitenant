<?php

namespace ClarkWinkelmann\CreateUserModal;

use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Extend;
use Flarum\Settings\SettingsRepositoryInterface;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\ApiSerializer(ForumSerializer::class))
        ->attribute('clarkwinkelmannCreateUserModal', function (ForumSerializer $serializer) {
            /**
             * @var SettingsRepositoryInterface $settings
             */
            $settings = app(SettingsRepositoryInterface::class);

            // We are using the core API endpoint for creating users,
            // which is accessible to anyone when signup is open, and accessible only to admins when signup is closed
            // We need to reflect whether the current user meets those criteria to show or hide the button
            return $serializer->getActor()->isAdmin() || ($settings->get('allow_sign_up') && $serializer->getActor()->hasPermission('clarkwinkelmann.createUserModal'));
        }),
];
