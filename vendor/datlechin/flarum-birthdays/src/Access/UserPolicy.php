<?php

namespace Datlechin\Birthdays\Access;

use Carbon\Carbon;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class UserPolicy extends AbstractPolicy
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function viewBirthday(User $actor, User $user)
    {
        if (!$actor->hasPermission('user.editOwnBirthday') && $this->isSuspended($user)) {
            return $this->deny();
        }

        if (($actor->id === $user->id && $actor->hasPermission('user.editOwnBirthday'))
            || $actor->hasPermission('user.viewBirthday')
        ) {
            return $this->allow();
        }

        return $this->deny();
    }

    public function editBirthday(User $actor, User $user)
    {
        if ($actor->isGuest() && !$user->exists || $this->settings->get('datlechin-birthdays.set_on_registration')) {
            return $this->allow();
        } else if ($user->id === $actor->id && $actor->hasPermission('user.editOwnBirthday') && !$this->isSuspended($user)) {
            return $this->allow();
        } else if ($actor->can('edit', $user)) {
            return $this->allow();
        }
    }

    // source https://github.com/FriendsOfFlarum/user-bio/blob/master/src/Access/UserPolicy.php
    protected function isSuspended(User $user): bool
    {
        return $user->suspended_until !== null
            && $user->suspended_until instanceof Carbon
            && $user->suspended_until->isFuture();
    }
}
