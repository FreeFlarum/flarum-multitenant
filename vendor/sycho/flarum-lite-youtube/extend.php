<?php

/*
 * This file is part of sycho/flarum-lite-youtube.
 *
 * Copyright (c) 2022 Sami Mazouz.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SychO\LiteYouTube;

use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js'),

    (new Extend\Formatter())
        ->configure(LiteYouTubeTemplate::class),
];
