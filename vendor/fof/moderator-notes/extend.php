<?php

/*
 * This file is part of fof/moderator-notes.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\ModeratorNotes;

use Flarum\Api\Serializer\CurrentUserSerializer;
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Extend;
use FoF\Impersonate\Events\Impersonated;
use FoF\ModeratorNotes\Api\Controller\CreateModeratorNoteController;
use FoF\ModeratorNotes\Api\Controller\DeleteModeratorNoteController;
use FoF\ModeratorNotes\Api\Controller\ListModeratorNotesController;
use FoF\ModeratorNotes\Provider\ModeratorNotesProvider;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),
    new Extend\Locales(__DIR__.'/resources/locale'),

    (new Extend\Routes('api'))
        ->get('/notes/{id}', 'moderator_notes.index', ListModeratorNotesController::class)
        ->post('/notes', 'moderator-notes.create', CreateModeratorNoteController::class)
        ->delete('/moderatorNotes/{id}', 'moderator_notes.delete', DeleteModeratorNoteController::class),

    (new Extend\ApiSerializer(CurrentUserSerializer::class))
        ->attributes(AddAttributesBasedOnPermission::class),

    (new Extend\ApiSerializer(UserSerializer::class))
        ->attributes(AddModeratorNoteCount::class),

    (new Extend\Event())
        ->listen(Impersonated::class, Listeners\Impersonate::class),

    (new Extend\ServiceProvider())
        ->register(ModeratorNotesProvider::class),
];
