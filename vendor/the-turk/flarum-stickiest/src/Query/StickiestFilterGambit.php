<?php

/*
 * This file is part of Stickiest.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace TheTurk\Stickiest\Query;

use Flarum\Filter\FilterInterface;
use Flarum\Filter\FilterState;
use Flarum\Search\AbstractRegexGambit;
use Flarum\Search\SearchState;
use Illuminate\Database\Query\Builder;

class StickiestFilterGambit extends AbstractRegexGambit implements FilterInterface
{
    protected function getGambitPattern()
    {
        return 'is:stickiest';
    }

    protected function conditions(SearchState $search, array $matches, $negate)
    {
        $this->constrain($search->getQuery(), $negate);
    }

    public function getFilterKey(): string
    {
        return 'stickiest';
    }

    public function filter(FilterState $filterState, string $filterValue, $negate)
    {
        $this->constrain($filterState->getQuery(), $negate);
    }

    protected function constrain(Builder $query, bool $negate)
    {
        $query->where('is_stickiest', !$negate);
    }
}
