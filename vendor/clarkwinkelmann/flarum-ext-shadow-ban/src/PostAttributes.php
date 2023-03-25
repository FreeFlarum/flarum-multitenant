<?php

namespace ClarkWinkelmann\ShadowBan;

use Flarum\Api\Serializer\PostSerializer;
use Flarum\Post\Post;

class PostAttributes
{
    public function __invoke(PostSerializer $serializer, Post $post): array
    {
        if ($serializer->getActor()->can('shadowHide', $post)) {
            return [
                'isShadowHidden' => !is_null($post->shadow_hidden_at),
                'canShadowHide' => true,
            ];
        }

        return [];
    }
}
