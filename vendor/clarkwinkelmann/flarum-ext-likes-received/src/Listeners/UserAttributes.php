<?php

namespace ClarkWinkelmann\LikesReceived\Listeners;

class UserAttributes
{
    public function __invoke($serializer, $user, $attributes): array
    {
        if ($serializer->getActor()->can('viewLikesReceived', $user)) {
            $attributes['likesReceived'] = $user->clarkwinkelmann_likes_received_count;
        }

        return $attributes;
    }
}
