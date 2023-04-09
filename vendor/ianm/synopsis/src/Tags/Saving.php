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

use Flarum\Tags\Event\Saving as Event;
use Illuminate\Support\Arr;

class Saving
{
    public function handle(Event $event)
    {
        $attributes = Arr::get($event->data, 'attributes', []);

        $excerptLength = Arr::get($attributes, 'excerptLength', '');
        $event->tag->excerpt_length = $excerptLength === '' ? null : $excerptLength;

        $richExcerpts = Arr::get($attributes, 'richExcerpts', false);
        $event->tag->rich_excerpts = $richExcerpts === null ? $richExcerpts : (bool) $richExcerpts;
    }
}
