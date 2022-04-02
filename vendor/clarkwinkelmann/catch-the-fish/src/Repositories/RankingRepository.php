<?php

namespace ClarkWinkelmann\CatchTheFish\Repositories;

use ClarkWinkelmann\CatchTheFish\Round;

class RankingRepository
{
    public function all(Round $round)
    {
        return $round->rankings()
            ->orderBy('catch_count', 'desc')
            ->get();
    }
}
