<?php

namespace Blomstra\Spam\Concerns;

use Flarum\Group\Group;
use Flarum\User\User;
use Blomstra\Spam\Filter;

trait Users
{
    public function isFreshUser(User $user): bool
    {
        $age = Filter::$userAge;
        $postsRequired = Filter::$userPostCount;

        if ($age && ($user->isGuest() || $user->joined_at->diffInHours() <= $age)) {
            return true;
        }

        if ($postsRequired && $user->posts->count() <= $postsRequired) {
            return true;
        }

        return false;
    }

    public function isElevatedUser(User $user): bool
    {
        return $user->groups->contains(Group::ADMINISTRATOR_ID)
            || $user->groups->contains(Group::MODERATOR_ID);
    }

    public function getModerator(): User
    {
        $user = null;

        // Use the specified admin if configured.
        if ($moderatorId = Filter::$moderatorUserId) {
            /** @var User $user */
            $user = User::query()->find($moderatorId);
        }

        if  ($user) return $user;

        /** @var User $user */
        $user = User::query()->whereHas('groups', function ($query) {
            $query->where('id', Group::ADMINISTRATOR_ID);
        })->first();

        return $user;
    }
}
