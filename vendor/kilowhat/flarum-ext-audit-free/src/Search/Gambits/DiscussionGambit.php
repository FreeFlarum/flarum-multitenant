<?php

namespace Kilowhat\Audit\Search\Gambits;

use Flarum\Search\AbstractRegexGambit;
use Flarum\Search\SearchState;

class DiscussionGambit extends AbstractRegexGambit
{
    protected function getGambitPattern(): string
    {
        return 'discussion:(.+)';
    }

    protected function conditions(SearchState $search, array $matches, $negate)
    {
        $ids = array_map(function ($id) {
            return intval($id); // Conversion to int is required for JSON comparison
        }, explode(',', trim($matches[1], '"')));

        $search->getQuery()->whereIn($search->getQuery()->raw('json_extract(payload, "$.discussion_id")'), $ids, 'and', $negate);
    }
}
