<?php

/*
 * This file is part of afrux/online-users-widget.
 *
 * Copyright (c) 2021 Sami Mazouz.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Afrux\OnlineUsers\Query;

use Afrux\OnlineUsers\UserRepository;
use Flarum\Filter\FilterInterface;
use Flarum\Filter\FilterState;
use Flarum\Search\AbstractRegexGambit;
use Flarum\Search\SearchState;
use Flarum\User\User;
use Illuminate\Database\Query\Builder;

class OnlineGambitFilter extends AbstractRegexGambit implements FilterInterface
{
    /**
     * @var UserRepository
     */
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(SearchState $search, $bit)
    {
        if (! $search->getActor()->hasPermission('user.viewLastSeenAt')) {
            return false;
        }

        return parent::apply($search, $bit);
    }

    /**
     * {@inheritdoc}
     */
    public function getGambitPattern()
    {
        return 'is:online';
    }

    /**
     * {@inheritdoc}
     */
    protected function conditions(SearchState $search, array $matches, $negate)
    {
        $this->constrain($search->getQuery(), $search->getActor(), $negate);
    }

    public function getFilterKey(): string
    {
        return 'online';
    }

    public function filter(FilterState $filterState, string $filterValue, bool $negate)
    {
        if (! $filterState->getActor()->hasPermission('user.viewLastSeenAt')) {
            return;
        }

        $this->constrain($filterState->getQuery(), $filterState->getActor(), $negate);
    }

    protected function constrain(Builder $query, User $actor, ?bool $negate = false)
    {
        // @TODO this is a temporary solution because the preferences are stored in a binary,
        // so we can't access individual users's discloseOnline preference, this should be perfected
        // when flarum core improves the way it stores preferences.
        $lastSeenUsers = $this->repository->getLastSeenUsers($actor);

        $query->whereIn('id', $lastSeenUsers);
    }
}
