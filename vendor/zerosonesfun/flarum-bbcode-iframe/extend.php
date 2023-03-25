<?php

/*
 * This file is part of zerosonesfun/flarum-bbcode-space.
 *
 * Copyright (c) 2022 Billy Wilcosky.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace ZerosOnesFun\Iframe;

use Flarum\Extend;
use s9e\TextFormatter\Configurator;

return [ 
  (new Extend\Frontend('forum'))
  ->css(__DIR__.'/less/forum.less'),
    (new Extend\Formatter)
    ->configure(function (Configurator $config) {
         $config->BBCodes->addCustom(
           '[iframe={URL}]',
           '<div class="iframe" style="--aspect-ratio: 16/9;">
           <iframe 
             src="{URL}"
             width="1600"
             height="900"
             frameborder="0"
           >
           </iframe>
         </div>'
        );
    })
];