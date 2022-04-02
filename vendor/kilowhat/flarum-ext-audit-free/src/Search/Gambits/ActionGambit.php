<?php

namespace Kilowhat\Audit\Search\Gambits;

use Flarum\Search\AbstractRegexGambit;
use Flarum\Search\SearchState;

class ActionGambit extends AbstractRegexGambit
{
    protected function getGambitPattern(): string
    {
        return 'action:(.+)';
    }

    protected function conditions(SearchState $search, array $matches, $negate)
    {
        $actions = explode(',', trim($matches[1], '"'));

        $search->getQuery()->whereIn('action', $actions, 'and', $negate);
    }
}
