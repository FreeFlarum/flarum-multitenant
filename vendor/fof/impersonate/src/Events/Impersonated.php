<?php

/*
 * This file is part of fof/impersonate.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\Impersonate\Events;

use Flarum\User\User;

class Impersonated
{
    /**
     * @var User
     */
    public $actor;

    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $switchReason;

    public function __construct(User $actor, User $user, string $switchReason)
    {
        $this->actor = $actor;
        $this->user = $user;
        $this->switchReason = $switchReason;
    }
}
