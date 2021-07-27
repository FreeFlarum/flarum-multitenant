<?php

/*
 * This file is part of ianm/level-ranks.
 *
 * Copyright (c) ReFlar.
 * Copyright (c) IanM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IanM\LevelRanks;

use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    new Extend\Locales(__DIR__.'/resources/locale'),

    (new Extend\Settings())
        ->serializeToForum('ianm-level-ranks.pointsText', 'ianm-level-ranks.pointsText'),
];
