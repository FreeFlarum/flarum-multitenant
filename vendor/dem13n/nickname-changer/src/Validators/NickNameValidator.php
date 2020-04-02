<?php

namespace Dem13n\NickName\Changer\Validators;

use Flarum\Foundation\AbstractValidator;
use Flarum\Settings\SettingsRepositoryInterface;

class NickNameValidator extends AbstractValidator
{
    protected function getRules()
    {
        $settings = app(SettingsRepositoryInterface::class);
        $unique_nickname = ($settings->get('dem13n_nickname_unique') == 0) ? 'unique:users,nickname' : '';

        return [
            'nickname' => [
                'unique:users,username',
                $unique_nickname,
                'regex:' . $settings->get('dem13n_nickname_regex'),
                'min:' . $settings->get('dem13n_nickname_min_char'),
                'max:' . $settings->get('dem13n_nickname_max_char'),
            ],
        ];
    }
}
