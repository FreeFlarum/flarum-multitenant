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

use Flarum\Post\Event\Saving;
use Ralkage\HCaptcha\Validators\HCaptchaValidator;
use Illuminate\Support\Arr;

class ReplyPostValidate
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
        if (!$event->post->exists) {
            // If it's a new discussion, the hCaptcha is already validated in discussion saving event
            // When this code runs, the discussion already exists, and the number has not been assigned to the post yet
            // So we look in the discussion number index, just like the reply permission check does in PostReplyHandler
            if ($event->post->discussion->post_number_index === 0) {
                return;
            }

            if ($event->actor->hasPermission('ralkage-hcaptcha.postWithoutHCaptcha')) {
                return;
            }

            $this->validator->assertValid([
                'hcaptcha' => Arr::get($event->data, 'attributes.h-captcha-response'),
            ]);
        }
    }
}
