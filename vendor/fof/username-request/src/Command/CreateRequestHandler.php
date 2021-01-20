<?php

/*
 * This file is part of fof/username-request.
 *
 * Copyright (c) 2019 - 2021 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace FoF\UserRequest\Command;

use Flarum\User\UserValidator;
use FoF\UserRequest\UsernameRequest;
use Illuminate\Support\Arr;

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

        $this->validator->assertValid([$attr => $username]);

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
