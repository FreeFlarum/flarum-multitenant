<?php

namespace ClarkWinkelmann\PasswordLess;

use Flarum\User\UserValidator;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Arr;

class MakePasswordOptional
{
    public function __invoke(UserValidator $flarumValidator, Validator $validator)
    {
        $rules = $validator->getRules();
        $passwordRules = Arr::get($rules, 'password', []);

        if (count($passwordRules)) {
            $rules['password'] = array_map(function ($rule) {
                if ($rule === 'required') {
                    return 'sometimes';
                }

                return $rule;
            }, $passwordRules);

            $validator->setRules($rules);
        }
    }
}
