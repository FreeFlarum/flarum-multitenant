<?php

/*
 * This file is part of fof/stopforumspam.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\StopForumSpam\Listeners;

use Flarum\Foundation\ValidationException;
use Flarum\User\Event\RegisteringFromProvider;
use FoF\StopForumSpam\StopForumSpam;
use Illuminate\Support\Arr;

class ProviderRegistration
{
    protected $sfs;

    public function __construct(StopForumSpam $sfs)
    {
        $this->sfs = $sfs;
    }

    public function handle(RegisteringFromProvider $event)
    {
        $check = $this->sfs->shouldPreventLogin([
            'ip'       => $this->getIpAddress(),
            'email'    => $event->user->email,
            'username' => $event->user->username,
        ], $event->provider, $event->payload);

        if ($check) {
            throw new ValidationException([
                'username' => resolve('translator')->trans('fof-stopforumspam.forum.message.spam'),
            ]);
        }
    }

    protected function getIpAddress(): ?string
    {
        $serverParams = $_SERVER;

        return Arr::get($serverParams, 'HTTP_CLIENT_IP')
            ?? Arr::get($serverParams, 'HTTP_CF_CONNECTING_IP')
            ?? Arr::get($serverParams, 'HTTP_X_FORWARDED_FOR')
            ?? Arr::get($serverParams, 'REMOTE_ADDR');
    }
}
