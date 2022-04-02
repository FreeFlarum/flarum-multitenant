<?php
/*
 * This file is part of zerosonesfun/flarum-inline-audio.
 *
 * Copyright (c) 2021 Billy Wilcosky.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace ZerosOnesFun\InlineAudio;

use Flarum\Extend;
use Flarum\Frontend\Document;

return [
    (new Extend\Frontend('forum'))
        ->content(function (Document $document) { $document->head[] = '<script>var observer=new MutationObserver(function(e){for(var o=0;o<e.length;o++)for(var r=0;r<e[o].addedNodes.length;r++)checkNode(e[o].addedNodes[r])});observer.observe(document.documentElement,{childList:!0,subtree:!0}),checkNode=function(e){1===e.nodeType&&e.matches(".PostStream")&&soundManager.reboot()};</script>'; })
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),
];