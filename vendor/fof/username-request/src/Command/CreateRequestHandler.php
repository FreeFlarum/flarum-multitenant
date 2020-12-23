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

use Flarum\User\UserValidator;
use FoF\UserRequest\UsernameRequest;

class CreateRequestHandler
{
    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * CreateRequestHandler constructor.
     *
     * @param UserValidator $validator
     */
    public function __construct(UserValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param CreateRequest $command
     *
     * @throws \Flarum\User\Exception\PermissionDeniedException
     * @throws \Illuminate\Validation\ValidationException'
     *
     * @return mixed
     */
    public function handle(CreateRequest $command)
    {
        $actor = $command->actor;
        $username = $command->data['attributes']['username'];

        $actor->assertCan('user.requestUsername');

        $this->validator->assertValid(['username' => $username]);

        UsernameRequest::unguard();

        $usernameRequest = UsernameRequest::firstOrNew([
            'user_id' => $actor->id,
        ]);

        $usernameRequest->user_id = $actor->id;
        $usernameRequest->requested_username = $username;
        $usernameRequest->status = 'Sent';
        $usernameRequest->reason = null;
        $usernameRequest->created_at = time();

        $usernameRequest->save();

        return $usernameRequest;
    }
}
