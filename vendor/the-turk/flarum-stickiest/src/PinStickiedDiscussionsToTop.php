<?php

/*
 * This file is part of Stickiest.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace TheTurk\Stickiest;

use Flarum\Filter\FilterState;
use Flarum\Query\QueryCriteria;
use Flarum\Tags\Query\TagFilterGambit;

class PinStickiedDiscussionsToTop
{
    public function __invoke(FilterState $filterState, QueryCriteria $criteria)
    {
        if ($criteria->sortIsDefault) {
            $query = $filterState->getQuery();
            
            // If we are viewing a specific tag, then pin stickied
            // discussions to the top and pin super stickied ones
            // to the uppermost no matter what.
            $filters = $filterState->getActiveFilters();

            if ($count = count($filters)) {
                if ($count === 1 && $filters[0] instanceof TagFilterGambit) {
                    if (! is_array($query->orders)) {
                        $query->orders = [];
                    }
                    
                    array_unshift($query->orders, ['column' => 'is_sticky', 'direction' => 'desc']);
                    array_unshift($query->orders, ['column' => 'is_stickiest', 'direction' => 'desc']);
                }

                return;
            }

            $query->where('is_tagSticky', false);

            // Otherwise, if we are viewing "all discussions", only pin stickied
            // discussions to the top if they are unread and pin super stickied
            // ones to the uppermost no matter what. To do this in a
            // performant way we create another query which will select all
            // stickied and super stickied discussions, marry them into the main query, order by
            // super stickied discussions and then reorder the unread ones up to the top.
            $sticky = clone $query;
            $sticky->where('is_sticky', true);
            $sticky->orders = null;

            $stickiest = clone $query;
            $stickiest->where('is_stickiest', true);
            $stickiest->orders = null;

            $query->union($sticky)->union($stickiest);

            $query->orderBy('is_stickiest', 'desc');

            $read = $query->newQuery()
                ->selectRaw(1)
                ->from('discussion_user as sticky')
                ->whereColumn('sticky.discussion_id', 'id')
                ->where('sticky.user_id', '=', $filterState->getActor()->id)
                ->whereColumn('sticky.last_read_post_number', '>=', 'last_post_number');
                
            // Add the bindings manually (rather than as the second
            // argument in orderByRaw) for now due to a bug in Laravel which
            // would add the bindings in the wrong order.
            $query->orderByRaw('is_sticky and not exists ('.$read->toSql().') and last_posted_at > ? desc')
                ->addBinding(array_merge($read->getBindings(), [$filterState->getActor()->read_time ?: 0]), 'union');
                
            $query->unionOrders = array_merge($query->unionOrders, $query->orders);
            $query->unionLimit = $query->limit;
            $query->unionOffset = $query->offset;

            $query->limit = $sticky->limit = $query->offset + $query->limit;
            $query->offset = $sticky->offset = null;
        }
    }
}