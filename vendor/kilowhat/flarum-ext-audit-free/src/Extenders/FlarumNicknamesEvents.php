<?php

namespace Kilowhat\Audit\Extenders;

use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Flarum\User\Event\Saving;
use Flarum\User\User;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Arr;
use Kilowhat\Audit\AuditLogger;

class FlarumNicknamesEvents implements ExtenderInterface
{
    protected $originalNickname = false;

    public function extend(Container $container, Extension $extension = null)
    {
        // We need to register the event listener in booted()
        // because that's where Extend\Event registers them
        // Ours should run after Nickname because of the extension's optional dependency tree
        $container->make('flarum')->booted(function () use ($container) {
            $container['events']->listen(Saving::class, [$this, 'saving']);
        });

        // There's no event for the nickname change at this time so we need to use a bit of Eloquent magic
        User::saved(function (User $user) {
            // The $originalNickname variable holds the old value but it also signifies that the nickname was updated
            if ($this->originalNickname !== false) {
                AuditLogger::log('user.nickname_changed', [
                    'user_id' => $user->id,
                    'old_nickname' => $this->originalNickname ?: null,
                    'new_nickname' => $user->nickname ?: null,
                ]);
            }
        });
    }

    public function saving(Saving $event)
    {
        $attributes = Arr::get($event->data, 'attributes', []);

        if (isset($attributes['nickname']) && $event->user->isDirty('nickname')) {
            $this->originalNickname = $event->user->getOriginal('nickname');
        }
    }
}
