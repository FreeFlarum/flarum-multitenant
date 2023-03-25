<?php

namespace ClarkWinkelmann\DiscussionBookmarks\Gambits;

use Flarum\Search\AbstractRegexGambit;
use Flarum\Search\SearchState;
use Illuminate\Database\Query\Builder;

class BookmarkedGambit extends AbstractRegexGambit
{
    protected function getGambitPattern(): string
    {
        return 'is:bookmarked';
    }

    protected function conditions(SearchState $search, array $matches, $negate)
    {
        $actor = $search->getActor();

        $method = $negate ? 'whereNotIn' : 'whereIn';
        $search->getQuery()->$method('id', function (Builder $query) use ($actor) {
            $query->select('discussion_id')
                ->from('discussion_user')
                ->where('user_id', $actor->id)
                ->whereNotNull('bookmarked_at');
        });
    }
}
