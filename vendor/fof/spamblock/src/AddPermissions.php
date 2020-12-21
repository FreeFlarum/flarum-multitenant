<?php

/*
 * This file is part of fof/spamblock.
 *
 * Copyright (c) 2018 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace FoF\Spamblock;

use Flarum\Api\Serializer\UserSerializer;
use Flarum\User\User;

class AddPermissions
{
    public function __invoke(UserSerializer $serializer, User $user, array $attributes): array
    {
        $attributes['canSpamblock'] = $serializer->getActor()->can('spamblock', $user);

        return $attributes;
    }
}
