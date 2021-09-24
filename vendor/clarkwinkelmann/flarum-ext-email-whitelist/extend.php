<?php

namespace ClarkWinkelmann\EmailWhitelist;

use Flarum\Extend;
use Flarum\User\UserValidator;
use Illuminate\Contracts\Validation\Validator;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js')
        ->css(__DIR__ . '/resources/less/admin.less'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\Validator(UserValidator::class))
        ->configure(function (UserValidator $flarumValidator, Validator $validator) {
            $rules = $validator->getRules();

            if (!array_key_exists('email', $rules)) {
                return;
            }

            $rules['email'][] = resolve(WhitelistRule::class);

            $validator->setRules($rules);
        }),
];
