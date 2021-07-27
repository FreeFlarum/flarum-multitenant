<?php

namespace Kilowhat\Audit\Search\Gambits;

use Flarum\Search\AbstractRegexGambit;
use Flarum\Search\SearchState;

class IpGambit extends AbstractRegexGambit
{
    protected function getGambitPattern(): string
    {
        return 'ip:(.+)';
    }

    protected function conditions(SearchState $search, array $matches, $negate)
    {
        $ipAddresses = explode(',', trim($matches[1], '"'));

        $search->getQuery()->whereIn('ip_address', $ipAddresses, 'and', $negate);
    }
}
