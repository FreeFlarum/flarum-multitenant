<?php

/*
 * This file is part of fof/amazon-affiliation.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\AmazonAffiliation;

use Illuminate\Support\Arr;
use Psr\Http\Message\UriInterface;

class AmazonLinkManipulator
{
    public $affiliateTags = [];
    public $keepExistingTag = false;
    public $removeTagIfUnhandled = false;

    /**
     * @param UriInterface $uri
     *
     * @return UriInterface|null
     */
    public function process(UriInterface $uri)
    {
        $matches = [];

        if (preg_match('~^(?:www\.)?(amazon\.((?:[a-z]{2,3}\.)?[a-z]{2,3}))$~', $uri->getHost(), $matches) !== 1) {
            return;
        }

        $amazonDomain = $matches[1];
        $topDomain = $matches[2];

        $tag = Arr::get($this->affiliateTags, $topDomain);

        parse_str($uri->getQuery(), $query);

        if ($tag) {
            if (!$this->keepExistingTag || !Arr::has($query, 'tag')) {
                Arr::set($query, 'tag', $tag);
            }
        } else {
            if ($this->removeTagIfUnhandled && Arr::has($query, 'tag')) {
                Arr::forget($query, 'tag');
            }
        }

        return $uri
            // Always make the scheme https
            ->withScheme('https')
            // Always add www subdomain
            ->withHost('www.'.$amazonDomain)
            // Rebuild the query. Even if it didn't change
            ->withQuery(http_build_query($query));
    }
}
