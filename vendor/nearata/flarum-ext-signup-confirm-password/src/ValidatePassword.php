<?php

namespace Nearata\SignUpConfirmPassword;

use Flarum\User\Event\Saving;
use Illuminate\Support\Arr;

class ValidatePassword
{
    protected $validator;

    public function __construct(CustomUserValidator $validator)
    {
        $this->validator = $validator;
    }

    public function handle(Saving $event)
    {
        $confirmPassword = Arr::get($event->data, 'attributes.confirmPassword');

        if (is_null($confirmPassword)) {
            return;
        }

        $password = Arr::get($event->data, 'attributes.password');

        $attributes = array_merge(
            $event->user->getAttributes(),
            compact('password'),
            compact('confirmPassword')
        );

        $this->validator->assertValid($attributes);
    }
}
