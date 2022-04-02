<?php

namespace Kilowhat\Audit\Extenders;

use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Flarum\Suspend\Event;
use Flarum\User\User;
use Illuminate\Contracts\Container\Container;
use Kilowhat\Audit\AuditLogger;

class FlarumSuspendEvents implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        $container['events']->listen(Event\Suspended::class, [$this, 'suspended']);
        $container['events']->listen(Event\Unsuspended::class, [$this, 'unsuspended']);
    }

    protected function log(User $user, string $action, array $payload = [])
    {
        AuditLogger::log("user.$action", array_merge([
            'user_id' => $user->id,
        ], $payload));
    }

    public function suspended(Event\Suspended $event)
    {
        $payload = [];

        if ($event->user->suspended_until) {
            $payload['until'] = $event->user->suspended_until->toIso8601String();
        }

        $this->log($event->user, 'suspended', $payload);
    }

    public function unsuspended(Event\Unsuspended $event)
    {
        $this->log($event->user, 'unsuspended');
    }
}
