<?php

/*
 * This file is part of fof/username-request.
 *
 * Copyright (c) 2019 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace FoF\UserRequest\Command;

use Flarum\User\User;

class DeleteRequest
{
    /**
     * The user performing the action.
     *
     * @var User
     */
    public $actor;

    /**
     * DeleteRequest constructor.
     *
     * @param User $actor
     */
    public function __construct(User $actor)
    {
        $this->actor = $actor;
    }
}
