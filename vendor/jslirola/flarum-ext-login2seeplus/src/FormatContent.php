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

use Flarum\Settings\SettingsRepositoryInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class FormatContent
{
    public function __construct()
    {
        $this->settings = resolve(SettingsRepositoryInterface::class);
        $this->translator = resolve(TranslatorInterface::class);
    }

    protected function truncate_html($string, $length)
    {
        $string = trim($string);
        $i = 0;
        $tags = array();

        preg_match_all('/<[^>]+>([^<]*)/', $string, $tagMatches, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
        foreach($tagMatches as $tagMatch)
        {
            if ($tagMatch[0][1] - $i >= $length)
                break;
            $tag = mb_substr(strtok($tagMatch[0][0], " \t\n\r\0\x0B>"), 1);
            if ($tag[0] != '/')
                $tags[] = $tag;
            elseif (end($tags) == mb_substr($tag, 1))
                array_pop($tags);
            $i += $tagMatch[1][1] - $tagMatch[0][1];
        }

        return mb_substr($string, 0, $length = min(mb_strlen($string), $length + $i)) . (count($tags = array_reverse($tags)) ? '</' . implode('></', $tags) . '>' : '');
    }

    protected function get_link($trans)
    {
        return '<a class="l2sp">' . $this->translator->trans($trans) . '</a>';
    }
}
