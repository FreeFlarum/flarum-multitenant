<?php

/*
 * This file is part of fof/username-request.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\UserRequest\Command;

use Flarum\User\User;

class DeleteRequest
{
    /**
     * The ID of the request.
     *
     * @var int
     */
    public $requestId;

    /**
     * The user performing the action.
     *
     * @var User
     */
    public $actor;

    /**
     * DeleteRequest constructor.
     *
     * @param int  $requestId
     * @param User $actor
     */
    public function __construct(int $requestId, User $actor)
    {
        $this->requestId = $requestId;
        $this->actor = $actor;
    }
}
