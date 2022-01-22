<?php

namespace ClarkWinkelmann\ShadowBan\Listener;

use Carbon\Carbon;
use ClarkWinkelmann\ShadowBan\Event\ShadowBannedUser;
use ClarkWinkelmann\ShadowBan\Event\ShadowUnbannedUser;
use Flarum\User\Event\Saving;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Support\Arr;

class SaveUser
{
    protected $validation;

    public function __construct(Factory $validation)
    {
        $this->validation = $validation;
    }

    public function handle(Saving $event)
    {
        $attributes = (array)Arr::get($event->data, 'attributes');

        if (Arr::exists($attributes, 'shadowBannedUntil')) {
            $event->actor->assertCan('shadowBan', $event->user);

            $this->validation->make(Arr::only($attributes, 'shadowBannedUntil'), [
                // Prevent choosing a date that exceeds the TIMESTAMP column max value
                'shadowBannedUntil' => 'nullable|date|before:2038-01-19 03:14:07 UTC',
            ])->validate();

            if ($attributes['shadowBannedUntil']) {
                $event->user->raise(new ShadowBannedUser($event->user, $event->actor, $event->user->shadow_banned_until));

                $event->user->shadow_banned_until = Carbon::parse($attributes['shadowBannedUntil']);
            } else {
                $event->user->raise(new ShadowUnbannedUser($event->user, $event->actor, $event->user->shadow_banned_until));

                $event->user->shadow_banned_until = null;
            }
        }
    }
}
