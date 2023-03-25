<?php

/*
 * This file is part of ralkage/flarum-hcaptcha.
 *
 * Copyright (c) Christian Lopez.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ralkage\HCaptcha\Listeners;

use Flarum\User\Event\Saving;
use Ralkage\HCaptcha\Validators\HCaptchaValidator;
use Illuminate\Support\Arr;

class RegisterValidate
{
    /**
     * @var HCaptchaValidator
     */
    protected $validator;

    /**
     * @param HCaptchaValidator $validator
     */
    public function __construct(HCaptchaValidator $validator)
    {
        $this->validator = $validator;
    }

    public function handle(Saving $event)
    {
        if (!$event->user->exists) {
            $this->validator->assertValid([
                'hcaptcha' => Arr::get($event->data, 'attributes.h-captcha-response'),
            ]);
        }
    }
}
