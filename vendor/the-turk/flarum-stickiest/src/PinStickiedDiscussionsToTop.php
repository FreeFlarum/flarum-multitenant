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
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\Tags\Query\TagFilterGambit;
use Flarum\Tags\TagRepository;
use Illuminate\Database\Query\Builder;

class PinStickiedDiscussionsToTop
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @var TagRepository
     */
    protected $tags;

    /**
     * @param Settings      $settings
     * @param TagRepository $tags
     */
    public function __construct(SettingsRepositoryInterface $settings, TagRepository $tags)
    {
        $this->settings = $settings;
        $this->tags = $tags;
    }

    public function __invoke(FilterState $filterState, QueryCriteria $criteria)
    {
        if ($criteria->sortIsDefault) {
            $query = $filterState->getQuery();

            $filters = $filterState->getActiveFilters();

            if ($count = count($filters)) {
                if ($count === 1 && $filters[0] instanceof TagFilterGambit) {
                    /**
                     * Specific Tag.
                     *
                     * Pin tag stickied and stickied discussions to the top
                     * and pin super stickied ones to the uppermost no matter what.
                     */
                    $tagSticky = clone $query;
                    $tagSticky->where('is_tag_sticky', true);

                    if ($tagSticky->count() > 0) {
                        $tagId = $this->tags->getIdForSlug($criteria->query['tag']);

                        if ($tagId) {
                            $tagSticky->whereNotIn('discussions.id', function (Builder $q) use ($tagId) {
                                $q->select('discussion_id')->from('discussion_sticky_tag')->where('tag_id', $tagId);
                            });

                            if ($tagSticky->count() > 0) {
                                $query->whereNotIn('discussions.id', $tagSticky->pluck('discussions.id')->toArray());
                            }
                        }
                    }

                    if (!is_array($query->orders)) {
                        $query->orders = [];
                    }

                    array_unshift($query->orders, ['column' => 'is_stickiest', 'direction' => 'desc'], ['column' => 'is_tag_sticky', 'direction' => 'desc'], ['column' => 'is_sticky', 'direction' => 'desc']);
                }

                return;
            }

            /**
             * All Discussions.
             *
             * Pin stickied discussions to the top if they are unread
             * and pin super stickied ones to the uppermost no matter what.
             * Tag stickies will be treated as they're non-sticky.
             */
            $displayTagSticky = (bool) $this->settings->get(
                'the-turk-stickiest.display_tag_sticky'
            );

            if (!$displayTagSticky) {
                $query->where('is_tag_sticky', false);
            }

            $sticky = clone $query;
            $sticky->where('is_sticky', true);
            $sticky->orders = null;

            $stickiest = clone $query;
            $stickiest->where('is_stickiest', true);

            $query->union($sticky)->union($stickiest);

            $read = $query->newQuery()
                ->selectRaw(1)
                ->from('discussion_user as sticky')
                ->whereColumn('sticky.discussion_id', 'id')
                ->where('sticky.user_id', '=', $filterState->getActor()->id)
                ->whereColumn('sticky.last_read_post_number', '>=', 'last_post_number');

            $tagStickyExcluder = $displayTagSticky ? ' and not is_tag_sticky' : '';

            $query->orderByRaw('is_stickiest'.$tagStickyExcluder.' desc, is_sticky and not exists ('.$read->toSql().') and last_posted_at > ? desc')
                ->addBinding(array_merge($read->getBindings(), [$filterState->getActor()->read_time ?: 0]), 'union');

            $query->unionOrders = array_merge($query->unionOrders, $query->orders);
            $query->unionLimit = $query->limit;
            $query->unionOffset = $query->offset;

            $query->limit = $sticky->limit = $query->offset + $query->limit;
            $query->offset = $sticky->offset = null;
        }
    }
}
