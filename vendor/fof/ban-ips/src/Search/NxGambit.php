<?php

/*
 * This file is part of fof/ban-ips.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\BanIPs\Search;

use Flarum\Filter\FilterInterface;
use Flarum\Filter\FilterState;
use Flarum\Search\GambitInterface;
use Flarum\Search\SearchState;

/**
 * We need to register at least one gambit for the searcher or filter, but we don't actually have any
 * We only configure the searcher/filterer so we can use pagination and for extensions to hook into.
 */
class NxGambit implements GambitInterface, FilterInterface
{
    public function getFilterKey(): string
    {
        return 'ban-ips-nx';
    }

    public function filter(FilterState $filterState, string $filterValue, bool $negate)
    {
        // Does nothing
    }

    public function apply(SearchState $search, $bit)
    {
        // Does nothing
    }
}
