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

use Flarum\User\UserValidator;
use FoF\UserRequest\UsernameRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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

        $actor->assertCan('user.requestUsername');

        $username = Arr::get($command->data, 'attributes.username');
        $forNickname = Arr::get($command->data, 'attributes.forNickname', false);

        $attr = $forNickname ? 'nickname' : 'username';

        // Setting nickname to username by making nickname null so
        // it falls back to username.
        if ($forNickname && $username === $actor->username) {
            $username = null;
        }

        // Allow for simply changing the case of a username, ie `user1` to `User1`
        // The UserValidator will respond by saying `this username has already been taken`, so we bypass if the username is the same
        if (Str::lower($actor->username) !== Str::lower($username)) {
            $this->validator->assertValid([$attr => $username]);
        }

        UsernameRequest::unguard();

        $usernameRequest = UsernameRequest::firstOrNew([
            'user_id'      => $actor->id,
            'for_nickname' => $forNickname,
        ]);

        $usernameRequest->user_id = $actor->id;
        $usernameRequest->requested_username = $username;
        $usernameRequest->for_nickname = $forNickname;
        $usernameRequest->status = 'Sent';
        $usernameRequest->reason = null;
        $usernameRequest->created_at = time();

        $usernameRequest->save();

        return $usernameRequest;
    }
}
