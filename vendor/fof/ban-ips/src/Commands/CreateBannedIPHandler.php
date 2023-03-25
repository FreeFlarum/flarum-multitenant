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

use Carbon\Carbon;
use Flarum\User\User;
use FoF\BanIPs\BannedIP;
use FoF\BanIPs\Events\IPWasBanned;
use FoF\BanIPs\Validators\BannedIPValidator;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Arr;

class CreateBannedIPHandler
{
    /**
     * @var BannedIPValidator
     */
    protected $validator;

    /**
     * @var Dispatcher
     */
    private $events;

    /**
     * @param Dispatcher        $events
     * @param BannedIPValidator $validator
     */
    public function __construct(Dispatcher $events, BannedIPValidator $validator)
    {
        $this->events = $events;
        $this->validator = $validator;
    }

    /**
     * @param CreateBannedIP $command
     *
     * @return mixed
     */
    public function handle(CreateBannedIP $command)
    {
        /**
         * @var User
         */
        $actor = $command->actor;
        $data = $command->data;

        $userId = Arr::get($data, 'attributes.userId');
        $user = $userId != null ? User::where('id', $userId)->orWhere('username', $userId)->firstOrFail() : null;

        $actor->assertCan('banIP', $user);

        $bannedIP = BannedIP::build(
            $actor->id,
            $user ? $user->id : null,
            Arr::get($data, 'attributes.address'),
            Arr::get($data, 'attributes.reason')
        );
        $bannedIP->created_at = Carbon::now();

        $this->validator->assertValid($bannedIP->getAttributes());

        $bannedIP->save();

        $this->events->dispatch(
            new IPWasBanned($actor, $bannedIP)
        );

        return $bannedIP;
    }
}
