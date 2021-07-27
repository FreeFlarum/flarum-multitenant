<?php

namespace Kilowhat\Audit\Search\Gambits;

use Flarum\Search\AbstractRegexGambit;
use Flarum\Search\SearchState;

class ClientGambit extends AbstractRegexGambit
{
    protected function getGambitPattern(): string
    {
        return 'client:(.+)';
    }

    protected function conditions(SearchState $search, array $matches, $negate)
    {
        $clients = explode(',', trim($matches[1], '"'));

        $search->getQuery()->whereIn('client', $clients, 'and', $negate);
    }
}
