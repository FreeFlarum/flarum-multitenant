<?php

namespace Kilowhat\Audit\Search\Gambits;

use Flarum\Search\AbstractRegexGambit;
use Flarum\Search\SearchState;
use Flarum\User\UserRepository;

class ActorGambit extends AbstractRegexGambit
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    protected function getGambitPattern(): string
    {
        return 'actor:(.+)';
    }

    protected function conditions(SearchState $search, array $matches, $negate)
    {
        $rawUsernames = trim($matches[1], '"');

        if ($rawUsernames === 'guest') {
            $search->getQuery()->whereNull('actor_id', 'and', $negate);
        } else {
            $usernames = explode(',', $rawUsernames);

            $ids = [];
            foreach ($usernames as $username) {
                $ids[] = $this->users->getIdForUsername($username);
            }

            $search->getQuery()->whereIn('actor_id', $ids, 'and', $negate);
        }
    }
}
