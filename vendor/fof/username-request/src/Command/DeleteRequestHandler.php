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

class DeleteRequestHandler
{
    /**
     * @param DeleteRequest $command
     *
     * @throws \Flarum\User\Exception\PermissionDeniedException
     *
     * @return mixed
     */
    public function handle(DeleteRequest $command)
    {
        $actor = $command->actor;

        $actor->assertCan('user.requestUsername');

        $usernameRequest = $actor->username_requests();

        $usernameRequest->delete();

        return $usernameRequest;
    }
}
