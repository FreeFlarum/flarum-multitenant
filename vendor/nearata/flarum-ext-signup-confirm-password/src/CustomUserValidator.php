<?php

namespace Nearata\SignUpConfirmPassword;

use Flarum\User\UserValidator;
use Illuminate\Validation\Factory;
use Symfony\Contracts\Translation\TranslatorInterface;

class CustomUserValidator extends UserValidator
{
    protected $rules;

    public function __construct(Factory $validator, TranslatorInterface $translator, PublicUserValidator $userValidator)
    {
        parent::__construct($validator, $translator);

        $this->rules = $userValidator->getUserValidatorRules();
    }

    public function getRules()
    {
        return array_merge(
            $this->rules,
            ['confirmPassword' => array_merge($this->rules['password'], ['same:password'])]
        );
    }
}

class PublicUserValidator extends UserValidator
{
    public function getUserValidatorRules()
    {
        return $this->getRules();
    }
}
