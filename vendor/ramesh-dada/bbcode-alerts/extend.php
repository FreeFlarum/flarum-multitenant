<?php

use Flarum\Extend;
use s9e\TextFormatter\Configurator;

return [
    (new Extend\Frontend('forum'))
        ->css(__DIR__ . '/resources/less/forum.less'),
    (new Extend\Formatter)
        ->configure(function (Configurator $config) {
            $config->BBCodes->addCustom(
                '[awarning]{TEXT}[/awarning]',
                '<div id="aaalertbody"><div class="aaalert aaerror"><p class="aainner"><strong>Warning! </strong>{TEXT}</p></div></div>'
            );

            $config->BBCodes->addCustom(
                '[asuccess]{TEXT}[/asuccess]',
                '<div id="aaalertbody"><div class="aaalert aasuccess"><p class="aainner">{TEXT}</p></div></div>'
            );

            $config->BBCodes->addCustom(
                '[ainfo]{TEXT}[/ainfo]',
                '<div id="aaalertbody"><div class="aaalert aainfo"><p class="aainner">{TEXT}</p></div></div>'
            );

            $config->BBCodes->addCustom(
                '[abasic]{TEXT}[/abasic]',
                '<div id="aaalertbody"><div class="aaalert"><p class="aainner">{TEXT}</p></div></div>'
            );

            $config->BBCodes->addCustom(
                '[acustom]{COLOR},{COLOR2},{COLOR3},{TEXT}[/acustom]',
                '<div id="aaalertbody"><div class="aaalert"><p class="aainner" style="color: {COLOR}; background-color: {COLOR2}; border-color: {COLOR3};">{TEXT}</p></div></div>'
            );

            $config->BBCodes->addCustom(
                '[bcustom]title={TEXT} font={COLOR} bg={COLOR2} border={COLOR3}[/bcustom]',
                '<div id="aaalertbody"><div class="aaalert"><p class="aainner" style="color: {COLOR}; background-color: {COLOR2}; border-color: {COLOR3};">{TEXT}</p></div></div>'
            );

            $config->BBCodes->addCustom(
                '[berror]{TEXT}[/berror]',
                '<div id="aaalertbody"><div class="bbalert-box bberror"><span>ERROR: </span>{TEXT}</div></div>'
            );

            $config->BBCodes->addCustom(
                '[cerror]{COLOR},{COLOR2},{COLOR3},{TEXT},{TEXT2}[/cerror]',
                '<div id="aaalertbody"><div class="bbalert-box bberror" style="color: {COLOR}; background-color: {COLOR2}; border-color: {COLOR3};"><span>{TEXT}: </span>{TEXT2}</div></div>'
            );

            $config->BBCodes->addCustom(
                '[bsuccess]{TEXT}[/bsuccess]',
                '<div id="aaalertbody"><div class="bbalert-box bbsuccess"><span>SUCCESS: </span>{TEXT}</div></div>'
            );

            $config->BBCodes->addCustom(
                '[csuccess]{COLOR},{COLOR2},{COLOR3},{TEXT},{TEXT2}[/csuccess]',
                '<div id="aaalertbody"><div class="bbalert-box bbsuccess" style="color: {COLOR}; background-color: {COLOR2}; border-color: {COLOR3};"><span>{TEXT}: </span>{TEXT2}</div></div>'
            );

            $config->BBCodes->addCustom(
                '[bwarning]{TEXT}[/bwarning]',
                '<div id="aaalertbody"><div class="bbalert-box bbwarning"><span>WARNING: </span>{TEXT}</div></div>'
            );

            $config->BBCodes->addCustom(
                '[cwarning]{COLOR},{COLOR2},{COLOR3},{TEXT},{TEXT2}[/cwarning]',
                '<div id="aaalertbody"><div class="bbalert-box bbwarning" style="color: {COLOR}; background-color: {COLOR2}; border-color: {COLOR3};"><span>{TEXT}: </span>{TEXT2}</div></div>'
            );

            $config->BBCodes->addCustom(
                '[bnotice]{TEXT}[/bnotice]',
                '<div id="aaalertbody"><div class="bbalert-box bbnotice"><span>Notice: </span>{TEXT}</div></div>'
            );

            $config->BBCodes->addCustom(
                '[cnotice]{COLOR},{COLOR2},{COLOR3},{TEXT},{TEXT2}[/cnotice]',
                '<div id="aaalertbody"><div class="bbalert-box bbnotice" style="color: {COLOR}; background-color: {COLOR2}; border-color: {COLOR3};"><span>{TEXT}: </span>{TEXT2}</div></div>'
            );

            $config->BBCodes->addCustom(
                '[derror title="{TEXT}" font="{COLOR}" bg="{COLOR2}" border="{COLOR3}"]{TEXT2}[/derror]',
                '<div id="aaalertbody"><div class="bbalert-box bberror" style="color: {COLOR}; background-color: {COLOR2}; border-color: {COLOR3};"><span>{TEXT}: </span>{TEXT2}</div></div>'
            );

            $config->BBCodes->addCustom(
                '[dsuccess title="{TEXT}" font="{COLOR}" bg="{COLOR2}" border="{COLOR3}"]{TEXT2}[/dsuccess]',
                '<div id="aaalertbody"><div class="bbalert-box bbsuccess" style="color: {COLOR}; background-color: {COLOR2}; border-color: {COLOR3};"><span>{TEXT}: </span>{TEXT2}</div></div>'
            );

            $config->BBCodes->addCustom(
                '[dwarning title="{TEXT}" font="{COLOR}" bg="{COLOR2}" border="{COLOR3}"]{TEXT2}[/dwarning]',
                '<div id="aaalertbody"><div class="bbalert-box bbwarning" style="color: {COLOR}; background-color: {COLOR2}; border-color: {COLOR3};"><span>{TEXT}: </span>{TEXT2}</div></div>'
            );

            $config->BBCodes->addCustom(
                '[dnotice title="{TEXT}" font="{COLOR}" bg="{COLOR2}" border="{COLOR3}"]{TEXT2}[/dnotice]',
                '<div id="aaalertbody"><div class="bbalert-box bbnotice" style="color: {COLOR}; background-color: {COLOR2}; border-color: {COLOR3};"><span>{TEXT}: </span>{TEXT2}</div></div>'
            );
        })
];
