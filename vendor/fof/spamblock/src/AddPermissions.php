<?php

/*
 * This file is part of fof/spamblock.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
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
