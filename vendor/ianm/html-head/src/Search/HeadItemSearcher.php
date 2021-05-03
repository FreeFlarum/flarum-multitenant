<?php

/*
 * This file is part of ianm/html-head.
 *
 * Copyright (c) 2021 IanM.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace IanM\HtmlHead\Search;

use Flarum\Query\ApplyQueryParametersTrait;
use Flarum\Query\QueryCriteria;
use Flarum\Query\QueryResults;
use Flarum\Search\GambitManager;
use Flarum\Search\SearchCriteria;
use Flarum\Search\SearchResults;
use Flarum\Search\SearchState;
use IanM\HtmlHead\Repositories\HtmlHeadRepository;

class HeadItemSearcher
{
    use ApplyQueryParametersTrait;

    /**
     * @var GambitManager
     */
    protected $gambits;

    /**
     * @var HtmlHeadRepository
     */
    protected $bannedIPs;

    /**
     * @param GambitManager      $gambits
     * @param BannedIPRepository $bannedIPs
     */
    public function __construct(GambitManager $gambits, HtmlHeadRepository $bannedIPs)
    {
        $this->gambits = $gambits;
        $this->bannedIPs = $bannedIPs;
    }

    /**
     * @param SearchCriteria $criteria
     * @param int|null       $limit
     * @param int            $offset
     *
     * @return SearchResults
     */
    public function search(QueryCriteria $criteria, $limit = null, $offset = 0): QueryResults
    {
        $actor = $criteria->actor;

        $query = $this->bannedIPs->query();

        if ($actor !== null && !$actor->isAdmin()) {
            $query->whereIsHidden(0);
        }

        $search = new SearchState($query->getQuery(), $actor);

        $this->gambits->apply($search, $criteria->query);

        $this->applySort($search, $criteria->sort);
        $this->applyOffset($search, $offset);
        $this->applyLimit($search, $limit + 1);

        $headItems = $query->get();

        if ($areMoreResults = ($limit > 0 && $headItems->count() > $limit)) {
            $headItems->pop();
        }

        return new QueryResults($headItems, $areMoreResults);
    }
}
