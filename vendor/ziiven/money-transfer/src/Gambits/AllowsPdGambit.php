<?php

/*
 * This file is part of fof/byobu.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ziven\transferMoney\Gambits;

use Flarum\Extension\ExtensionManager;
use Flarum\Search\AbstractRegexGambit;
use Flarum\Search\SearchState;
use Illuminate\Contracts\Events\Dispatcher;

use Ziven\transferMoney\Events\SearchingRecipient;

class AllowsPdGambit extends AbstractRegexGambit
{
    /**
     * @var Dispatcher
     */
    public $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function getGambitPattern()
    {
        return 'allows-pd';
    }

    protected function conditions(SearchState $search, array $matches, $negate)
    {
        $actor = $search->getActor();

        $this->dispatcher->dispatch(new SearchingRecipient($search, $matches, $negate));

        $search
            ->getQuery()
            // Always prevent PD's by non-privileged users to suspended users.
            ->when(
                $this->extensionEnabled('flarum-suspend') && !$negate,
                function ($query) {
                    $query->whereNull('suspended_until');
                }
            )
            ->orderBy('username', 'asc');
    }

    protected function extensionEnabled(string $extension)
    {
        /** @var ExtensionManager $manager */
        $manager = resolve(ExtensionManager::class);

        return $manager->isEnabled($extension);
    }
}
