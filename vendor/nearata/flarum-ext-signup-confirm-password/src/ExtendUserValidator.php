<?php

namespace Nearata\SignUpConfirmPassword;

use Flarum\User\UserValidator;
use Illuminate\Validation\Factory;
use Symfony\Contracts\Translation\TranslatorInterface;

class ExtendUserValidator extends UserValidator
{
    protected $rules;

    public function __construct(Factory $validator, TranslatorInterface $translator, UserValidatorAccessor $userValidator)
    {
        parent::__construct($validator, $translator);

        $this->rules = $userValidator->getValidatorRules();
    }

    public function getRules()
    {
        return array_merge(
            $this->rules,
            ['confirmPassword' => array_merge($this->rules['password'], ['same:password'])]
        );
    }
}

class UserValidatorAccessor extends UserValidator
{
    public function getValidatorRules()
    {
        return $this->getRules();
    }
}
