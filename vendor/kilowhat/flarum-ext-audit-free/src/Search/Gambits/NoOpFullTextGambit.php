<?php

namespace Kilowhat\Audit\Search\Gambits;

use Flarum\Search\GambitInterface;
use Flarum\Search\SearchState;

class NoOpFullTextGambit implements GambitInterface
{
    public function apply(SearchState $search, $bit)
    {
        // Doesn't do anything for now, but required by the Search API
    }
}
