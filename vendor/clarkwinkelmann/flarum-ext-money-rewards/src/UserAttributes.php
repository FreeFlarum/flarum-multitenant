<?php

namespace ClarkWinkelmann\MoneyRewards;

use Flarum\Api\Serializer\BasicUserSerializer;
use Flarum\User\User;

class UserAttributes
{
    public function __invoke(BasicUserSerializer $serializer, User $user): array
    {
        if ($serializer->getActor()->cannot('seeMoneyRewardHistory', $user)) {
            return [];
        }

        return [
            'canSeeMoneyRewardHistory' => true,
        ];
    }
}
