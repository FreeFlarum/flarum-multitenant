<?php

/*
 * This file is part of fof/transliterator
 *
 * Copyright (c) 2018 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\Transliterator\Listeners;

use Flarum\Discussion\Event\Saving;
use FoF\Transliterator\Transliterator;
use Illuminate\Support\Arr;

class TransliterateUrl
{
    public function handle(Saving $event)
    {
        if (Arr::has($event->data, 'attributes.title')) {
            $event->discussion->slug = Transliterator::transliterate($event->discussion->title);
        }
    }
}
