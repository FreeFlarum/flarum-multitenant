<?php

namespace ClarkWinkelmann\Status;

use Flarum\Api\Serializer\UserSerializer;
use Flarum\User\User;

class UserAttributes
{
    public function __invoke(UserSerializer $serializer, User $user): array
    {
        $attributes = [];

        if ($serializer->getActor()->hasPermission('clarkwinkelmann-status.see')) {
            $attributes['clarkwinkelmannStatusEmoji'] = $user->clarkwinkelmann_status_emoji;
            $attributes['clarkwinkelmannStatusText'] = $user->clarkwinkelmann_status_text;
        }

        if ($serializer->getActor()->can('clarkwinkelmannStatusEdit', $user)) {
            $attributes['clarkwinkelmannStatusCanEdit'] = true;
        }

        return $attributes;
    }
}
