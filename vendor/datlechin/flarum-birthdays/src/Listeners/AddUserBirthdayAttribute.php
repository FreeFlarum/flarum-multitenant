<?php

/*
 * This file is part of datlechin/flarum-birthdays.
 *
 * Copyright (c) 2022 Ngo Quoc Dat.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Datlechin\Birthdays\Listeners;

use Flarum\Api\Serializer\UserSerializer;
use Flarum\User\User;

class AddUserBirthdayAttribute
{
    public function __invoke(UserSerializer $serializer, User $user, array $attributes): array
    {
        $actor = $serializer->getActor();

        if ($actor->can('viewBirthday', $user)) {
            $attributes['birthday'] = $user->birthday;
            $attributes['showDobDate'] = $user->showDobDate ? true : false;
            $attributes['showDobYear'] = $user->showDobYear ? true : false;
            $attributes['canEditOwnBirthday'] = $actor->id === $user->id && $actor->can('editOwnBirthday', $user);
        }
        return $attributes;
    }
}
