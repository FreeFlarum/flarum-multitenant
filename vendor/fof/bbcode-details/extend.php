<?php

/*
 * This file is part of fof/bbcode-details.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Flarum\Extend;
use s9e\TextFormatter\Configurator;

return [
    (new Extend\Frontend('forum'))
        ->css(__DIR__.'/less/forum.less')
        ->js(__DIR__.'/js/dist/forum.js'),

    (new Extend\Formatter())
        ->configure(function (Configurator $configurator) {
            $configurator->BBCodes->addCustom(
                '[DETAILS title={TEXT1;optional}]{TEXT2}[/DETAILS]',
                '<details><summary>{TEXT1}</summary><div>{TEXT2}</div></details>'
            );
        }),
];
