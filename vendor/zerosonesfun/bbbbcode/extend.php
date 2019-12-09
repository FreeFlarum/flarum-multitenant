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
            $document->head[] = '<link rel="stylesheet" type="text/css" href="/assets/extensions/zerosonesfun-bbbbcode/styles.css"><script src="/assets/extensions/zerosonesfun-bbbbcode/index.js"></script>';
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
                '<span class="{TEXT7}"><strong>Sorry. There was bbcode here which showed an image of a cartoon animal but that particular bbcode is no longer supported. Admin/mod feel free to edit and delete this code from this post.</strong></span>'
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
               '[audio mp3="{URL22?}" ogg="{URL23?}"]',
               '<p><audio class="bbaudio inline-exclude" controls>
                        <source src="{URL22}" type="audio/mpeg">
                        <source src="{URL23}" type="audio/ogg">
                </audio></p>'
            );
             $config->BBCodes->addCustom(
               '[audio m4a="{URL3?}" oggm4a="{URL4?}"]',
               '<p><audio class="bbaudio inline-exclude" style="width:100%;outline:none;" controls>
                        <source src="{URL3}" type="audio/mp4">
                        <source src="{URL4}" type="audio/ogg">
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
                    <strong>{TEXT28}:</strong> <span class="chat-b-normal">{TEXT29}</span>
                </p>'
            );
             $config->BBCodes->addCustom(
               '[space]',
               '<p class="space"></p>'
            );
             $config->BBCodes->addCustom(
               '[spoiler={ANYTHING2;optional;defaultValue=Read More}]{ANYTHING3}[/spoiler]',
               '<details>
                <summary>{ANYTHING2}</summary>
                <p>{ANYTHING3}</p>
                </details>'
            );
             $config->BBCodes->addCustom(
               '[blur]{ANYTHING4}[/blur]',
               '<p class="bbspoiler-blur">
                {ANYTHING4}
                </p>'
            );
             $config->BBCodes->addCustom(
               '[red]{TEXT30}[/red]',
               '<span class="bbred">{TEXT30}</span>'
            );
             $config->BBCodes->addCustom(
               '[orange]{TEXT31}[/orange]',
               '<span class="bborange">{TEXT31}</span>'
            );
             $config->BBCodes->addCustom(
               '[yellow]{TEXT32}[/yellow]',
               '<span class="bbyellow">{TEXT32}</span>'
            );
             $config->BBCodes->addCustom(
               '[green]{TEXT33}[/green]',
               '<span class="bbgreen">{TEXT33}</span>'
            );
             $config->BBCodes->addCustom(
               '[blue]{TEXT34}[/blue]',
               '<span class="bbblue">{TEXT34}</span>'
            );
             $config->BBCodes->addCustom(
               '[purple]{TEXT35}[/purple]',
               '<span class="bbpurple">{TEXT35}</span>'
            );
             $config->BBCodes->addCustom(
               '[hl]{TEXT36}[/hl]',
               '<span class="bbhighlight">{TEXT36}</span>'
            );
             $config->BBCodes->addFromRepository('BACKGROUND');
             $config->BBCodes->addFromRepository('FONT');
             $config->BBCodes->addFromRepository('TABLE');
             $config->BBCodes->addFromRepository('TBODY');
             $config->BBCodes->addFromRepository('TD');
             $config->BBCodes->addFromRepository('TH');
             $config->BBCodes->addFromRepository('TR');
             $config->BBCodes->addFromRepository('THEAD');
        })
];
