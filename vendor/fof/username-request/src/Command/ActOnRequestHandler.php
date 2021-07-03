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

use Flarum\User\UserRepository;
use Flarum\User\UserValidator;
use FoF\UserRequest\UsernameRequest;
use Illuminate\Support\Str;

class ActOnRequestHandler
{
    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * CreateRequestHandler constructor.
     *
     * @param UserValidator $validator
     */
    public function __construct(UserValidator $validator, UserRepository $users)
    {
        $this->validator = $validator;
        $this->users = $users;
    }

    /**
     * @param ActOnRequest $command
     *
     * @throws \Flarum\User\Exception\PermissionDeniedException
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return mixed
     */
    public function handle(ActOnRequest $command)
    {
        $actor = $command->actor;
        $data = $command->data;

        $usernameRequest = UsernameRequest::findOrFail($command->requestId);
        $user = $this->users->findOrFail($usernameRequest->user_id);

        if (isset($data['attributes']['delete']) && $actor->id === $user->id) {
            return $usernameRequest->delete();
        }

        $actor->assertCan('user.viewUsernameRequests');

        $usernameRequest->status = $data['attributes']['action'];

        if ($usernameRequest->status === 'Approved') {
            $attr = $usernameRequest->for_nickname ? 'nickname' : 'username';

            // Allow for simply changing the case of a username, ie `user1` to `User1`
            // The UserValidator will respond by saying `this username has already been taken`, so we bypass if the username is the same
            if (Str::lower($user->username) !== Str::lower($usernameRequest->requested_username)) {
                $this->validator->assertValid([$attr => $usernameRequest->requested_username]);
            }

            if ($attr === 'username') {
                $usernameHistory = json_decode($user->username_history, true);

                $usernameHistory === null ? $usernameHistory = [] : $usernameHistory;

                array_push($usernameHistory, [$user->username => time()]);
                $user->username_history = json_encode($usernameHistory);
            }

            $user->$attr = $usernameRequest->requested_username;
            $user->save();
        } else {
            $usernameRequest->reason = $data['attributes']['reason'];
        }

        $usernameRequest->save();

        return $usernameRequest;
    }
}
