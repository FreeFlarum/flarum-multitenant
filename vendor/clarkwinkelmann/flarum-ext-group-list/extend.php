<?php

namespace ClarkWinkelmann\GroupList;

use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Extend;
use Flarum\Settings\SettingsRepositoryInterface;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/resources/less/forum.less')
        ->route('/groups', 'clarkwinkelmann-group-list'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js')
        ->css(__DIR__ . '/resources/less/admin.less'),
    new Extend\Locales(__DIR__ . '/resources/locale'),
    (new Extend\Routes('api'))
        ->get('/clarkwinkelmann-group-list', 'clarkwinkelmann-group-list.index', Controllers\GroupListController::class)
        ->post('/clarkwinkelmann-group-list-items', 'clarkwinkelmann-group-list.create', Controllers\ItemStoreController::class)
        ->patch('/clarkwinkelmann-group-list-items/{id:[0-9]+}', 'clarkwinkelmann-group-list.update', Controllers\ItemUpdateController::class)
        ->delete('/clarkwinkelmann-group-list-items/{id:[0-9]+}', 'clarkwinkelmann-group-list.delete', Controllers\ItemDeleteController::class),
    (new Extend\ApiSerializer(ForumSerializer::class))
        ->attributes(function (ForumSerializer $serializer): array {
            /**
             * @var $settings SettingsRepositoryInterface
             */
            $settings = resolve(SettingsRepositoryInterface::class);

            return [
                'clarkwinkelmann-group-list.showSideNavLink' => $settings->get('clarkwinkelmann-group-list.showSideNavLink') !== '0' && $serializer->getActor()->hasPermission('clarkwinkelmann-group-list.see'),
                'clarkwinkelmann-group-list.showAvatarBadges' => $settings->get('clarkwinkelmann-group-list.showAvatarBadges') === '1',
                'clarkwinkelmann-group-list.showOnlineStatus' => $settings->get('clarkwinkelmann-group-list.showOnlineStatus') === '1',
            ];
        }),
];
