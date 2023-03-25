<?php

namespace Kilowhat\Audit;

use Flarum\Extend;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js')
        ->css(__DIR__ . '/resources/less/admin.less'),

    (new Extend\Routes('api'))
        ->get('/kilowhat-audit/logs', 'kilowhat-audit.index', Controllers\AuditIndexController::class),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\Middleware('forum'))
        ->add(Middlewares\SetLoggerActor::class),
    (new Extend\Middleware('admin'))
        ->add(Middlewares\SetLoggerActor::class),
    (new Extend\Middleware('api'))
        ->add(Middlewares\SetLoggerActor::class),

    new Extenders\CoreDiscussionEvents(),
    new Extenders\CorePostEvents(),
    new Extenders\CoreUserEvents(),
    new Extenders\FlarumApprovalEvents(),
    new Extenders\FlarumFlagsEvents(),
    new Extenders\FlarumLockEvents(),
    new Extenders\FlarumNicknamesEvents(),
    new Extenders\FlarumStickyEvents(),
    new Extenders\FlarumSuspendEvents(),
    new Extenders\FlarumTagsEvents(),

    (new Extend\SimpleFlarumSearch(Search\AuditSearcher::class))
        ->setFullTextGambit(Search\Gambits\NoOpFullTextGambit::class)
        ->addGambit(Search\Gambits\ActionGambit::class)
        ->addGambit(Search\Gambits\ActorGambit::class)
        ->addGambit(Search\Gambits\ClientGambit::class)
        ->addGambit(Search\Gambits\DiscussionGambit::class)
        ->addGambit(Search\Gambits\IpGambit::class)
        ->addGambit(Search\Gambits\UserGambit::class),

    (new Extend\Console())
        ->command(Console\ClearLogsCommand::class),

    (new Extend\ServiceProvider())
        ->register(LoggerServiceProvider::class),
];
