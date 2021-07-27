<?php

namespace XEngine\Signature\Model;

use Flarum\Api\Event\Serializing;
use Flarum\Event\PrepareApiAttributes;
use Flarum\Event\UserWillBeSaved;
use Illuminate\Contracts\Events\Dispatcher;
use Flarum\User\Event\Saving;
use Illuminate\Support\Arr;

class UserSignatureAttributes
{
    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(Saving::class, [$this, 'whenUserWillBeSaved']);
    }

    /**
     * @param UserWillBeSaved $event
     */
    public function whenUserWillBeSaved(Saving $event)
    {
        $attributes = Arr::get($event->data, 'attributes', []);
        if (array_key_exists('signature', $attributes)) {
            $user = $event->user;
            $actor = $event->actor;
            if ($actor->id !== $user->id) {
                $actor->assertCan('edit', $user);
            }
            $user->signature = $attributes['signature'];
        }
    }
}
