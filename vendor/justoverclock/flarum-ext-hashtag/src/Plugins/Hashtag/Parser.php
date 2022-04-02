<?php

namespace Justoverclock\Hashtag\Plugins\Hashtag;

use s9e\TextFormatter\Plugins\ParserBase;

class Parser extends ParserBase
{

    public function parse($text, array $matches)
    {
        $tagName = $this->config['tagName'];

        foreach ($matches as $m) {
            /**
             * $m looks like the following:
             * [
             *   ["#hashtag", 0],
             *   ["hashtag", 1],
             * ];
             */

            $tag = $this->parser->addSelfClosingTag(
                $tagName,
                $m[0][1],
                \strlen($m[0][0]),
                -10
            );

            $tag->setAttributes(
                [
                    'query'    => $m[1][0],
                ]
            );
        }
    }
}
