<?php

namespace App\Mail;

use Flarum\Mail\SmtpDriver as Native;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Support\MessageBag;

class SmtpDriver extends Native
{
    public function validate(SettingsRepositoryInterface $settings, Factory $validator): MessageBag
    {
        return $validator->make($settings->all(), [
            'mail_host' => 'required',
            'mail_port' => 'nullable|integer',
            'mail_encryption' => 'nullable|in:tls,ssl',
            'mail_username' => 'string',
            'mail_password' => 'string',
        ])->errors();
    }
}
