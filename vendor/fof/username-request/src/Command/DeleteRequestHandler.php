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

        $usernameRequest = $actor->nameChangeRequests()->where('id', $command->requestId)->first();

        $usernameRequest->delete();

        return $usernameRequest;
    }
}
