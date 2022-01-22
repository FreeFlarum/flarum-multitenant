<?php

namespace ClarkWinkelmann\CatchTheFish\Serializers;

use ClarkWinkelmann\CatchTheFish\Fish;
use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Api\Serializer\BasicDiscussionSerializer;
use Flarum\Api\Serializer\BasicUserSerializer;
use Flarum\Api\Serializer\PostSerializer;
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Foundation\ValidationException;
use Tobscure\JsonApi\Relationship;
use Tobscure\JsonApi\Resource;

class FishSerializer extends AbstractSerializer
{
    protected $type = 'catchthefish-fishes';

    protected function actorCan($ability, $arguments = [])
    {
        // Handle ValidationExceptions in policy as a denied policy
        // Would have been better with AuthorizationExceptions but these aren't available until a newer Laravel
        try {
            return $this->actor->can($ability, $arguments);
        } catch (ValidationException $exception) {
            return false;
        }
    }

    /**
     * @param Fish $fish
     * @return array
     */
    protected function getDefaultAttributes($fish): array
    {
        $canPlace = $this->actorCan('place', $fish);

        return [
            'name' => $fish->name,
            'image_url' => $fish->image_url,
            'placement' => $this->actorCan('catch', $fish) || $this->actorCan('catchthefish.moderate') ? [
                'discussion_id' => $fish->discussion_id_placement,
                'post_id' => $fish->post_id_placement,
                'user_id' => $fish->user_id_placement,
            ] : null,
            'canSee' => $this->actorCan('see', $fish),
            'canCatch' => $this->actorCan('catch', $fish),
            'canName' => $this->actorCan('name', $fish),
            'canPlace' => $canPlace,
            'placeUntil' => $canPlace ? $this->formatDate($fish->placement_valid_since) : null,
        ];
    }

    public function round($fish): ?Relationship
    {
        return $this->buildRelationship($fish, RoundSerializer::class, 'round');
    }

    public function lastUserPlacement($fish): ?Relationship
    {
        return $this->buildRelationship($fish, UserSerializer::class, 'lastUserPlacement');
    }

    public function lastUserNaming($fish): ?Relationship
    {
        return $this->buildRelationship($fish, UserSerializer::class, 'lastUserNaming');
    }

    protected function placementRelationship($data, string $serializer): ?Relationship
    {
        if (!$data) {
            return null;
        }

        $serializer = $this->resolveSerializerClass($serializer);

        $element = new Resource($data, $serializer);

        return new Relationship($element);
    }

    public function placement(Fish $fish): ?Relationship
    {
        if ($fish->discussion_id_placement) {
            return $this->placementRelationship($fish->placementDiscussion()->whereVisibleTo($this->actor)->first(), BasicDiscussionSerializer::class);
        }

        if ($fish->post_id_placement) {
            return $this->placementRelationship($fish->placementPost()->whereVisibleTo($this->actor)->first(), PostSerializer::class);
        }

        if ($fish->user_id_placement) {
            return $this->placementRelationship($fish->placementUser()->whereVisibleTo($this->actor)->first(), BasicUserSerializer::class);
        }

        return null;
    }
}
