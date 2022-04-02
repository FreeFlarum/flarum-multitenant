<?php

/*
 * This file is part of datlechin/flarum-birthdays.
 *
 * Copyright (c) 2022 Ngo Quoc Dat.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Datlechin\Birthdays\Listeners;

use Flarum\User\Event\Saving;
use Illuminate\Support\Arr;

class SaveBirthdayToDatabase
{

    /**
     * Handle the event.
     *
     * @param Saving $event
     */
    public function handle(Saving $event)
    {
        $user = $event->user;
        $data = $event->data;
        $actor = $event->actor;
        $attributes = Arr::get($data, 'attributes', []);

        $actor->assertCan('editBirthday', $user);

        if (isset($attributes['showDobDate'])) $user->showDobDate = $attributes['showDobDate'];
        if (isset($attributes['showDobYear'])) $user->showDobYear = $attributes['showDobYear'];

        if (isset($attributes['birthday'])) {
            $user->birthday = $attributes['birthday'] === '' ? null : $attributes['birthday'];
        }
    }
}
