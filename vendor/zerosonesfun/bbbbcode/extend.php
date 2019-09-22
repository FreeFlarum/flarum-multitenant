<?php

/*
 * This file is part of Flarum.
 *
 * The creator of bbbbcode is Billy Wilcosky. https://wilcosky.com
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Flarum\Extend;
use Flarum\Frontend\Document;
use s9e\TextFormatter\Configurator;

return [
    (new Extend\Frontend('forum'))
        ->content(function (Document $document) {
            $document->head[] = '<link rel="stylesheet" type="text/css" href="/assets/extensions/zerosonesfun-bbbbcode/styles.css">';
        }),
    (new Extend\Formatter)
        ->configure(function (Configurator $config) {
            $config->BBCodes->addCustom(
                '[tooltip="{TEXT1}" placement="{TEXT2}"]{TEXT3}[/tooltip]',
                '<span class="bb-tooltip" data-tooltip="{TEXT1}" data-placement="{TEXT2}">{TEXT3}</span>'
            );
            $config->BBCodes->addCustom(
                '[accordion header="{TEXT4}"]{TEXT5}[/accordion]',
                '<div class="accordion">
                    <input type="radio" name="radacc" class="accordion-chk" />
                    <h3 class="accordion-header Button--primary">
                        {TEXT4}
                    <span class="acc-icon"><i class="fas fa-chevron-circle-down"></i></span>
                    </h3>
                    <div class="accordion-content Button">
                        <p>
                        {TEXT5}
                        </p>
                    </div>
                </div>'
            );
            $config->BBCodes->addCustom(
                '[action]{TEXT6}[/action]',
                '<div class="asterisk asterisk-3">
                    <div class="asterisk-line"></div>
                    <div class="asterisk-line"></div>
                    <div class="asterisk-line"></div>
                 </div>
                    <span class="action-text">{TEXT6}</span>
                    <div class="asterisk asterisk-3">
                    <div class="asterisk-line"></div>
                    <div class="asterisk-line"></div>
                    <div class="asterisk-line"></div>
                 </div>'
            );
            $config->BBCodes->addCustom(
                '[animal="{TEXT7}"]',
                '<span class="{TEXT7}"></span>'
            );
             $config->BBCodes->addCustom(
               '[pop button="{TEXT8}" title="{ANYTHING}" content="{ANYTHING1}"]',
               '<div id="popmain">
                    <a href="#popmodal-{ANYTHING}{ANYTHING1}" class="popbtn Button Button--primary">{TEXT8}</a>
                </div>
                    <div id="popmodal-{ANYTHING}{ANYTHING1}">
                    <div class="popcontainer">
                            <h2>{ANYTHING}</h2>
                                <p>{ANYTHING1}</p>
                    <div class="poplink">
                    <a href="#popmain" class="popbtn Button Button--primary"><i class="fas fa-window-close"></i>&nbsp; close</a>
                    </div>
                </div>
            </div>'
            );
             $config->BBCodes->addCustom(
               '[audio mp3="{URL22}" ogg="{URL23}"]',
               '<p><audio controls>
                        <source src="{URL22}" type="audio/mpeg">
                        <source src="{URL23}" type="audio/ogg">
                </audio></p>'
            );
             $config->BBCodes->addCustom(
               '[audio mp3="{URL24}"]',
               '<p><audio controls>
                        <source src="{URL24}" type="audio/mpeg">
                </audio></p>'
            );
             $config->BBCodes->addCustom(
               '[audio ogg="{URL25}"]',
               '<p><audio controls>
                        <source src="{URL25}" type="audio/ogg">
                </audio></p>'
            );
             $config->BBCodes->addCustom(
               '[chat-a="{TEXT27}" who="{TEXT26}"]',
               '<p class="chat-a Button">
                    <strong>{TEXT26}:</strong> {TEXT27}
                </p>'
            );
             $config->BBCodes->addCustom(
               '[chat-b="{TEXT29}" who="{TEXT28}"]',
               '<p class="chat-b Button--primary">
                    <strong>{TEXT28}:</strong> {TEXT29}
                </p>'
            );
             $config->BBCodes->addCustom(
               '[space]',
               '<p class="space"></p>'
            );
             $config->BBCodes->addCustom(
               '[spoiler="{ANYTHING2}"]{ANYTHING3}[/spoiler]',
               '<a href="#hide-{ANYTHING2}{ANYTHING3}" class="hide-{ANYTHING2}{ANYTHING3} btn" id="hide-{ANYTHING2}{ANYTHING3}"><span class="getinline">{ANYTHING2}</span> <i class="fas fa-chevron-down"></i></a>
                <a href="#show-{ANYTHING2}{ANYTHING3}" class="show-{ANYTHING2}{ANYTHING3} btn" id="show-{ANYTHING2}{ANYTHING3}"><span class="getinline">{ANYTHING2}</span> <i class="fas fa-chevron-up"></i></a>
                <div class="spoiler">
                     <p class="spoiler-content">{ANYTHING3}</p>
                </div>'
            );
        })
];
