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
use Flarum\User\User;

class AddAttributesBasedOnPermission
{
    public function __invoke(CurrentUserSerializer $serializer, User $user, array $attributes): array
    {
        $actor = $serializer->getActor();

        if ($value = $actor->can('viewModeratorNotes', $user)) {
            $attributes['canViewModeratorNotes'] = $value;
        }

        if ($value = $actor->can('createModeratorNotes', $user)) {
            $attributes['canCreateModeratorNotes'] = $value;
        }

        if ($value = $actor->hasPermission('user.deleteModeratorNotes')) {
            $attributes['canDeleteModeratorNotes'] = $value;
        }

        return $attributes;
    }
}
