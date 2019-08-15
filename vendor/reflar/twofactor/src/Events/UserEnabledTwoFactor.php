<?php

namespace Reflar\twofactor\Events;

use Flarum\User\User;

class UserEnabledTwoFactor
{
    /**
     * @var User
     */
    public $actor;

    /**
     * UserEnabledTwoFactor constructor.
     *
     * @param User $actor
     */
    public function __construct(User $actor)
    {
        $this->actor = $actor;
    }
}
