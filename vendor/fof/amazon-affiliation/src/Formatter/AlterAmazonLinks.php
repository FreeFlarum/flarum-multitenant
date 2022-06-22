<?php

/*
 * This file is part of fof/amazon-affiliation.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\AmazonAffiliation\Formatter;

use FoF\AmazonAffiliation\AmazonLinkManipulator;
use Illuminate\Support\Arr;
use Laminas\Diactoros\Uri;
use s9e\TextFormatter\Renderer;
use s9e\TextFormatter\Utils;

class AlterAmazonLinks
{
    public function __invoke(Renderer $renderer, $context, $xml)
    {
        return Utils::replaceAttributes($xml, 'URL', function ($attributes) {
            if (Arr::has($attributes, 'url')) {
                /**
                 * @var AmazonLinkManipulator
                 */
                $manipulator = resolve(AmazonLinkManipulator::class);

                $uri = $manipulator->process(new Uri(Arr::get($attributes, 'url')));

                if ($uri) {
                    $attributes['url'] = (string) $uri;
                }
            }

            return $attributes;
        });
    }
}
