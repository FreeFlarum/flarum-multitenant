<?php

/*
 * This file is part of fof/bbcode-tabs.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\BBCodeTabs;

use Flarum\Extend;
use s9e\TextFormatter\Configurator;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),

    (new Extend\Formatter())
        ->configure(function (Configurator $configurator) {
            $configurator->BBCodes->addCustom(
                '[tabs]{TEXT}[/tabs]',
                '<div class="tabs"><xsl:apply-templates/></div>'
            );

            $configurator->BBCodes->addCustom(
                '[tab name={ANYTHING} active={ANYTHING?}]{TEXT}[/tab]',
                <<<'XML'
<div class="tab">
    <input type="radio">
        <xsl:if test="@active">
            <xsl:attribute name="checked">checked</xsl:attribute>
        </xsl:if>
    </input>
    <label>{@name}</label>

    <div class="content">
        <xsl:apply-templates/>
    </div>
</div>
XML
            );
        }),
];
