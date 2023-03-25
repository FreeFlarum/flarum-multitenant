<?php

/*
 * This file is part of fof/ban-ips.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\BanIPs\Commands;

use Flarum\User\User;
use FoF\BanIPs\BannedIP;
use FoF\BanIPs\Events\IPWasBanned;
use FoF\BanIPs\Repositories\BannedIPRepository;
use FoF\BanIPs\Validators\BannedIPValidator;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Events\Dispatcher as DispatcherEvents;
use Illuminate\Support\Arr;

class BanUserHandler
{
    /**
     * @var Dispatcher
     */
    private $bus;

    /**
     * @var DispatcherEvents
     */
    private $events;

    /**
     * @var BannedIPRepository
     */
    private $bannedIPs;

    /**
     * @var BannedIPValidator
     */
    private $validator;

    /**
     * @param Dispatcher         $bus
     * @param DispatcherEvents   $events
     * @param BannedIPRepository $bannedIPs
     * @param BannedIPValidator  $validator
     */
    public function __construct(Dispatcher $bus, DispatcherEvents $events, BannedIPRepository $bannedIPs, BannedIPValidator $validator)
    {
        $this->bus = $bus;
        $this->events = $events;
        $this->bannedIPs = $bannedIPs;
        $this->validator = $validator;
    }

    /**
     * @param BanUser $command
     *
     * @return mixed
     */
    public function handle(BanUser $command)
    {
        /**
         * @var User
         */
        $actor = $command->actor;
        $data = $command->data;

        /**
         * @var User
         */
        $user = User::where('id', $command->userId)->orWhere('username', $command->userId)->firstOrFail();
        $reason = Arr::get($data, 'attributes.reason');

        $actor->assertCan('banIP', $user);

        $ips = $this->bannedIPs->getUserIPs($user);

        $bannedIPs = [];

        foreach ($ips as $address) {
            $bannedIP = BannedIP::build(
                $actor->id,
                $user->id,
                $address,
                $reason
            );

            $this->validator->assertValid($bannedIP->getAttributes());

            $bannedIP->save();

            $this->events->dispatch(
                new IPWasBanned($actor, $bannedIP)
            );

            $bannedIPs[] = $bannedIP;
        }

        return $bannedIPs;
    }
}
