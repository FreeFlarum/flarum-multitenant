<?php

/*
 * This file is part of jslirola/flarum-ext-login2seeplus.
 *
 * Copyright (c) 2020
 * Original Extension by WiseClock
 * Updated by jslirola
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JSLirola\Login2SeePlus;

class HideContentInPostPreviews extends FormatContent
{
    public function __invoke($serializer, $model, $attributes)
    {
        $newHTML = $attributes["contentHtml"];

        if (!$serializer->getActor()->isGuest())
            return $attributes;

        $s_summary_links = $this->settings->get('jslirola.login2seeplus.link', false);

        if (!is_null($newHTML) && $s_summary_links == 1)
            $newHtml = preg_replace('/(<a((?!PostMention).)*?>)[^<]*<\/a>/is',
                '[' . $this->get_link('jslirola-login2seeplus.forum.link') . ']', $newHtml);

        $attributes['contentHtml'] = $newHTML;

        return $attributes;
    }

}
