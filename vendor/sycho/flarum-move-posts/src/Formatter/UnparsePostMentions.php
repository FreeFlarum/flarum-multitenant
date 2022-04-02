<?php

/*
 * This file is part of sycho/flarum-move-posts.
 *
 * Copyright (c) 2021 Sami Mazouz.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SychO\MovePosts\Formatter;

use s9e\TextFormatter\Utils;

class UnparsePostMentions
{
    public function __invoke($context, string $xml)
    {
        $post = $context;

        return Utils::replaceAttributes($xml, 'POSTMENTION', function ($attributes) use ($post) {
            $post = $post->mentionsPosts->find($attributes['id']);

            if ($post) {
                $attributes['number'] = $post->number;
                $attributes['discussionid'] = $post->discussion_id;
            }

            return $attributes;
        });
    }
}
