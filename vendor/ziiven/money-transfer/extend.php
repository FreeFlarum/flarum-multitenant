<?php

use Flarum\Extend;
use Flarum\Api\Serializer\ForumSerializer;

use Ziven\transferMoney\Controller\ListTransferMoneyHistoryController;
use Ziven\transferMoney\Controller\TransferMoneyController;
use Ziven\transferMoney\Notification\TransferMoneyBlueprint;
use Ziven\transferMoney\Serializer\TransferMoneySerializer;
use Ziven\transferMoney\Gambits\AllowsPdGambit;

use Flarum\User\Search\UserSearcher;
use Flarum\User\User;

$extend = [
    (new Extend\Frontend('admin'))->js(__DIR__.'/js/dist/admin.js'),
    (new Extend\Frontend('forum'))->js(__DIR__ . '/js/dist/forum.js')->css(__DIR__.'/less/forum.less'),
    (new Extend\Locales(__DIR__ . '/locale')),
    
    (new Extend\ApiSerializer(ForumSerializer::class))
        ->attribute('allowUseTranferMoney', function (ForumSerializer $serializer) {
            return $serializer->getActor()->hasPermission("transferMoney.allowUseTranferMoney");
        }),
    (new Extend\Routes('api'))
        ->post('/transferMoney', 'money.transfer', TransferMoneyController::class)
        ->get('/transferHistory', 'money.history', ListTransferMoneyHistoryController::class),
    (new Extend\Notification())
        ->type(TransferMoneyBlueprint::class, TransferMoneySerializer::class, ['alert']),

    (new Extend\SimpleFlarumSearch(UserSearcher::class))
        ->addGambit(AllowsPdGambit::class),

    (new Extend\Settings())
        ->serializeToForum('moneyTransferClient1Customization', 'moneyTransfer.moneyTransferClient1Customization')
        ->serializeToForum('moneyTransferTimeZone', 'moneyTransfer.moneyTransferTimeZone'),
];

return $extend;