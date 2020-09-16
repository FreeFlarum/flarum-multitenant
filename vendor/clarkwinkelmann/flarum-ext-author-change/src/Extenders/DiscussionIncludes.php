<?php

namespace ClarkWinkelmann\AuthorChange\Extenders;

use Flarum\Api\Controller\CreateDiscussionController;
use Flarum\Api\Controller\ShowDiscussionController;
use Flarum\Api\Controller\UpdateDiscussionController;
use Flarum\Api\Event\WillGetData;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

class DiscussionIncludes implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        $container['events']->listen(WillGetData::class, [$this, 'includes']);
    }

    public function includes(WillGetData $event)
    {
        if ($event->isController(ShowDiscussionController::class)
            || $event->isController(CreateDiscussionController::class)
            || $event->isController(UpdateDiscussionController::class)) {
            $event->addInclude([
                'user',
            ]);
        }
    }
}
