<?php

namespace ClarkWinkelmann\ShadowBan;

use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Discussion\Discussion;

class DiscussionAttributes
{
    public function __invoke(DiscussionSerializer $serializer, Discussion $discussion): array
    {
        if ($serializer->getActor()->can('shadowHide', $discussion)) {
            return [
                'isShadowHidden' => !is_null($discussion->shadow_hidden_at),
                'canShadowHide' => true,
            ];
        }

        return [];
    }
}
