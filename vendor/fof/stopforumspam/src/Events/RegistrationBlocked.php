<?php

/*
 * This file is part of fof/stopforumspam.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\StopForumSpam\Events;

class RegistrationBlocked
{
    public $username;
    public $ipAddress;
    public $email;
    public $data;
    public $provider;
    public $providerData;

    public function __construct(string $username, ?string $ipAddress, string $email, array $data = [], ?string $provider = null, ?array $providerData = null)
    {
        $this->username = $username;
        $this->ipAddress = $ipAddress;
        $this->email = $email;
        $this->data = $data;
        $this->provider = $provider;
        $this->providerData = $providerData;
    }
}
