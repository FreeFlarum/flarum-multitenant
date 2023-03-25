<?php

namespace Nearata\SignUpConfirmPassword;

use Flarum\User\Event\Saving;
use Illuminate\Support\Arr;

class ValidatePassword
{
    protected $validator;

    public function __construct(ExtendUserValidator $validator)
    {
        $this->validator = $validator;
    }

    public function handle(Saving $event)
    {
        $password = Arr::get($event->data, 'attributes.password');
        $confirmPassword = Arr::get($event->data, 'attributes.confirmPassword');

        if (is_null($password) && is_null($confirmPassword)) {
            return;
        }

        $attributes = array_merge(
            $event->user->getAttributes(),
            compact('password'),
            compact('confirmPassword')
        );

        $this->validator->assertValid($attributes);
    }
}
