<?php

/*
 * This file is part of fof/ban-ips.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\BanIPs\Search;

use Flarum\Filter\AbstractFilterer;
use Flarum\User\User;
use FoF\BanIPs\Repositories\BannedIPRepository;
use Illuminate\Database\Eloquent\Builder;

class BannedIPFilterer extends AbstractFilterer
{
    protected $bannedIPs;

    public function __construct(array $filters, array $filterMutators, BannedIPRepository $bannedIPs)
    {
        parent::__construct($filters, $filterMutators);

        $this->bannedIPs = $bannedIPs;
    }

    protected function getQuery(User $actor): Builder
    {
        return $this->bannedIPs->query();
    }
}
