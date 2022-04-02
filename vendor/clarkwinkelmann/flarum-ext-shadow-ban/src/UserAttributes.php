<?php

namespace ClarkWinkelmann\ShadowBan;

use Flarum\Api\Serializer\UserSerializer;
use Flarum\User\User;

class UserAttributes
{
    public function __invoke(UserSerializer $serializer, User $user): array
    {
        if ($serializer->getActor()->can('shadowBan', $user)) {
            return [
                'shadowBannedUntil' => $serializer->formatDate($user->shadow_banned_until),
                'canShadowBan' => true,
            ];
        }

        return [];
    }
}
