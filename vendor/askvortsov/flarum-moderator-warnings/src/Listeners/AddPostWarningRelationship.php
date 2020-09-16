<?php

/*
 * This file is part of askvortsov/flarum-moderator-warnings
 *
 *  Copyright (c) 2020 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Askvortsov\FlarumWarnings\Listeners;

use Askvortsov\FlarumWarnings\Api\Serializer\WarningSerializer;
use Flarum\Api\Controller;
use Flarum\Api\Event\WillGetData;
use Flarum\Api\Serializer\BasicPostSerializer;
use Flarum\Event\GetApiRelationship;
use Illuminate\Contracts\Events\Dispatcher;

class AddPostWarningRelationship
{
    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(GetApiRelationship::class, [$this, 'getApiRelationship']);
        $events->listen(WillGetData::class, [$this, 'includeRelationships']);
    }

    /**
     * @param GetApiRelationship $event
     *
     * @return \Tobscure\JsonApi\Relationship|null
     */
    public function getApiRelationship(GetApiRelationship $event)
    {
        if ($event->isRelationship(BasicPostSerializer::class, 'warnings')) {
            $actor = $event->serializer->getActor();
            $author = $event->model->user;
            if ($author && $actor->id == $author->id || $actor->can('user.viewWarnings', $author)) {
                return $event->serializer->hasMany($event->model, WarningSerializer::class, 'warnings');
            }
        }
    }

    /**
     * @param WillGetData $event
     */
    public function includeRelationships(WillGetData $event)
    {
        if ($event->isController(Controller\ShowDiscussionController::class)) {
            $event->addInclude([
                'posts.warnings',
                'posts.warnings.warnedUser',
                'posts.warnings.addedByUser',
            ]);
        }

        if ($event->isController(Controller\ListPostsController::class)
            || $event->isController(Controller\ShowPostController::class)) {
            $event->addInclude([
                'warnings',
                'warnings.warnedUser',
                'warnings.addedByUser',
            ]);
        }
    }
}
