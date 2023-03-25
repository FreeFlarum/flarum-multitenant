<?php

namespace ClarkWinkelmann\MoneyRewards;

use Flarum\Api\Serializer\BasicPostSerializer;
use Flarum\Post\Post;

class PostAttributes
{
    public function __invoke(BasicPostSerializer $serializer, Post $post): array
    {
        if ($serializer->getActor()->can('rewardWithMoney', $post)) {
            return [
                'rewardWithMoney' => true,
            ];
        }

        return [];
    }
}
