<?php

namespace ClarkWinkelmann\AuthorChange;

use Flarum\Api\Serializer\ForumSerializer;

class ForumAttributes
{
    public function __invoke(ForumSerializer $serializer): array
    {
        return [
            'clarkwinkelmannAuthorChangeCanEditUser' => $serializer->getActor()->can('clarkwinkelmann-author-change.edit-user'),
            'clarkwinkelmannAuthorChangeCanEditDate' => $serializer->getActor()->can('clarkwinkelmann-author-change.edit-date'),
        ];
    }
}
