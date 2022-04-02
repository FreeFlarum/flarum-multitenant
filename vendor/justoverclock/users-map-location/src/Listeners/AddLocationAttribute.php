<?php

namespace Justoverclock\UsersMapLocation\Listeners;

use Flarum\Api\Serializer\UserSerializer;
use Flarum\User\User;

class AddLocationAttribute
{
    public function __invoke(UserSerializer $serializer, User $user, array $attributes): array
    {
        $actor = $serializer->getActor();

        $attributes['location'] = $user->location;

        return $attributes;
    }
}
