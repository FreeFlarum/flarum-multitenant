<?php

/*
 * This file is part of fof/ignore-users.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\IgnoreUsers\User\Search\Gambit;

use Flarum\Search\AbstractRegexGambit;
use Flarum\Search\SearchState;

class IgnoredGambit extends AbstractRegexGambit
{
    public function getGambitPattern()
    {
        return 'is:ignor(?:ing|ed)';
    }

    /**
     * {@inheritdoc}
     */
    protected function conditions(SearchState $search, array $matches, $negate)
    {
        $actor = $search->getActor();

        $method = $negate ? 'whereNotExists' : 'whereExists';

        $search->getQuery()->$method(
            function ($query) use ($actor) {
                $query->selectRaw('1')
                    ->from('ignored_user')
                    ->whereColumn('users.id', 'ignored_user_id')
                    ->where('user_id', $actor->id);
            }
        );
    }
}
