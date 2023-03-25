<?php

/*
 * This file is part of ianm/synopsis.
 *
 * (c) 2020 - 2022 Ian Morland
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IanM\Synopsis\Tags;

use Flarum\Tags\Api\Serializer\TagSerializer;
use Flarum\Tags\Tag;

class AddTagsAttrs
{
    public function __invoke(TagSerializer $serializer, Tag $tag, array $attributes): array
    {
        $attributes['richExcerpts'] = $tag->rich_excerpts;
        $attributes['excerptLength'] = $tag->excerpt_length;

        return $attributes;
    }
}
