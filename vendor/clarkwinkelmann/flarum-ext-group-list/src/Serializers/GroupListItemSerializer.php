<?php

namespace ClarkWinkelmann\GroupList\Serializers;

use ClarkWinkelmann\GroupList\GroupListItem;
use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Api\Serializer\GroupSerializer;
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Formatter\Formatter;
use Tobscure\JsonApi\Relationship;

class GroupListItemSerializer extends AbstractSerializer
{
    protected $type = 'clarkwinkelmann-group-list-items';

    /**
     * @param GroupListItem $item
     * @return array
     */
    protected function getDefaultAttributes($item): array
    {
        $attributes = [
            'content' => null,
            'contentHtml' => null,
        ];

        if ($item->content) {
            /**
             * @var $formatter Formatter
             */
            $formatter = resolve(Formatter::class);

            $attributes['content'] = $formatter->unparse($item->content);
            $attributes['contentHtml'] = $formatter->render($item->content);
        }

        return $attributes;
    }

    public function group($item): ?Relationship
    {
        return $this->hasOne($item, GroupSerializer::class);
    }

    public function members($item): ?Relationship
    {
        return $this->hasMany($item, UserSerializer::class);
    }
}
