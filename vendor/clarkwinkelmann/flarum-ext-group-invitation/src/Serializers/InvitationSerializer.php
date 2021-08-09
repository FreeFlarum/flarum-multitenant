<?php

namespace ClarkWinkelmann\GroupInvitation\Serializers;

use ClarkWinkelmann\GroupInvitation\Invitation;
use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Api\Serializer\GroupSerializer;
use Tobscure\JsonApi\Relationship;

class InvitationSerializer extends AbstractSerializer
{
    protected $type = 'group-invitations';

    /**
     * @param Invitation $invitation
     * @return array
     */
    protected function getDefaultAttributes($invitation): array
    {
        $attributes = [
            'code' => $invitation->code,
            'hasUsagesLeft' => $invitation->hasUsagesLeft(),
            'canUse' => $this->actor->can('use', $invitation),
        ];

        if ($this->actor->isAdmin()) {
            $attributes += [
                'usageCount' => $invitation->usage_count,
                'maxUsage' => $invitation->max_usage,
                'createdAt' => $this->formatDate($invitation->created_at),
            ];
        }

        return $attributes;
    }

    public function group($invitation): ?Relationship
    {
        return $this->hasOne($invitation, GroupSerializer::class);
    }
}
