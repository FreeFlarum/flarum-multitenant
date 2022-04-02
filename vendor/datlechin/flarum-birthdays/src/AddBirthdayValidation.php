<?php

/*
 * This file is part of datlechin/flarum-birthdays.
 *
 * Copyright (c) 2022 Ngo Quoc Dat.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Datlechin\Birthdays;

use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Validation\Validator;
use Symfony\Contracts\Translation\TranslatorInterface;

class AddBirthdayValidation
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;


    public function __construct(TranslatorInterface $translator, SettingsRepositoryInterface $settings)
    {
        $this->translator = $translator;
        $this->settings = $settings;
    }

    /**
     * @param Validator $validator
     */
    public function __invoke($flarumValidator, Validator $validator)
    {
        $rules = $validator->getRules();

        $rules['birthday'] = [
            (bool) $this->settings->get('datlechin-birthdays.required') && (bool) $this->settings->get('datlechin-birthdays.set_on_registration') ? 'required' : 'nullable',
            'date_format:Y-m-d',
            'before:today',
            function ($attribute, $value, $fail) {
                if ($value) {
                    $birthday = new \DateTime($value);
                    $now = new \DateTime();
                    $diff = $now->diff($birthday);
                    if ($diff->y <= (int) $this->settings->get('datlechin-birthdays.min_age')) {
                        $fail($this->translator->trans('datlechin-birthdays.api.invalid_age_message', [
                            'minAge' => (int) $this->settings->get('datlechin-birthdays.min_age')
                        ]));
                    } else if ($diff->y > 100) {
                        $fail($this->translator->trans('datlechin-birthdays.api.invalid_dob_message'));
                    }
                }
            },
        ];

        $validator->setRules($rules);
    }
}
