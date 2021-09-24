<?php

/*
 * This file is part of zerosonesfun/flarum-inline-audio.
 *
 * Copyright (c) 2021 Billy Wilcosky.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Zerosonesfun\InlineAudio;

use Flarum\Extend;
use Flarum\Frontend\Document;
use s9e\TextFormatter\Configurator;

return [
    (new Extend\Frontend('forum'))
        ->content(function (Document $document) { $document->head[] = '<script src="../assets/extensions/zerosonesfun-inline-audio/sm2.js"></script><script src="../assets/extensions/zerosonesfun-inline-audio/bar-ui.js"></script><script src="../assets/extensions/zerosonesfun-inline-audio/inline-player.js"></script><script src="../assets/extensions/zerosonesfun-inline-audio/reboot.js"></script>'; })
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),
    
    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\Formatter)
    ->configure(function (Configurator $config) {
        $config->BBCodes->addCustom(
            '[player artist={SIMPLETEXT1?;defaultValue=Playing} title={SIMPLETEXT2?;defaultValue=Audio}]{URL}[/player]',
            '<div class="sm2-bar-ui compact full-width flat">

            <div class="bd sm2-main-controls">
           
             <div class="sm2-inline-texture"></div>
             <div class="sm2-inline-gradient"></div>
           
             <div class="sm2-inline-element sm2-button-element">
              <div class="sm2-button-bd">
               <a href="#play" class="sm2-inline-button sm2-icon-play-pause">Play / pause</a>
              </div>
             </div>
           
             <div class="sm2-inline-element sm2-inline-status">
           
             <div class="sm2-playlist">
             <div class="sm2-playlist-target">
              <noscript><p>JavaScript is required.</p></noscript>
             </div>
            </div>
           
              <div class="sm2-progress">
               <div class="sm2-row">
               <div class="sm2-inline-time">0:00</div>
                <div class="sm2-progress-bd">
                 <div class="sm2-progress-track">
                  <div class="sm2-progress-bar"></div>
                  <div class="sm2-progress-ball"><div class="icon-overlay"></div></div>
                 </div>
                </div>
                <div class="sm2-inline-duration">0:00</div>
               </div>
              </div>
           
             </div>
           
             <div class="sm2-inline-element sm2-button-element sm2-volume">
              <div class="sm2-button-bd">
               <span class="sm2-inline-button sm2-volume-control volume-shade"></span>
               <a href="#volume" class="sm2-inline-button sm2-volume-control">volume</a>
              </div>
             </div>
           
            </div>
           
            <div class="bd sm2-playlist-drawer sm2-element">
           
             <div class="sm2-inline-texture">
              <div class="sm2-box-shadow"></div>
             </div>
           
             <div class="sm2-playlist-wrapper">
               <ul class="sm2-playlist-bd">
                <li><a href="{URL}" class="inline-exclude"><b>{SIMPLETEXT1}</b> - {SIMPLETEXT2}</a></li>
               </ul>
             </div>
           
            </div>
           
           </div>'
        );
    })
];
