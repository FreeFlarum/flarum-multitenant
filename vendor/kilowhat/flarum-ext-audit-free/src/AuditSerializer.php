<?php

namespace Kilowhat\Audit;

use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Api\Serializer\BasicDiscussionSerializer;
use Flarum\Api\Serializer\BasicPostSerializer;
use Flarum\Api\Serializer\BasicUserSerializer;
use Flarum\Tags\Api\Serializer\TagSerializer;
use Tobscure\JsonApi\Relationship;

class AuditSerializer extends AbstractSerializer
{
    protected $type = 'kilowhat-audit';

    /**
     * @param AuditLog $log
     * @return array
     */
    protected function getDefaultAttributes($log): array
    {
        return [
            'actorId' => $log->actor_id,
            'client' => $log->client,
            'ipAddress' => $log->ip_address,
            'action' => $log->action,
            'payload' => $log->payload,
            'createdAt' => $this->formatDate($log->created_at),
        ];
    }

    public function actor($log): ?Relationship
    {
        return $this->hasOne($log, BasicUserSerializer::class);
    }

    public function discussion($log): ?Relationship
    {
        return $this->hasOne($log, BasicDiscussionSerializer::class);
    }

    public function post($log): ?Relationship
    {
        return $this->hasOne($log, BasicPostSerializer::class);
    }

    public function tag($log): ?Relationship
    {
        return $this->hasOne($log, TagSerializer::class);
    }

    public function user($log): ?Relationship
    {
        return $this->hasOne($log, BasicUserSerializer::class);
    }
}
