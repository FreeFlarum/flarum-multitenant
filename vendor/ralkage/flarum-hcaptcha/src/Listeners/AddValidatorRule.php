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

use Flarum\Foundation\AbstractValidator;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Validation\Validator;
use HCaptcha\hCaptcha;

class AddValidatorRule
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @param SettingsRepositoryInterface $settings
     */
    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(AbstractValidator $flarumValidator, Validator $validator)
    {
        $secret = $this->settings->get('ralkage-hcaptcha.credentials.secret');

        $validator->addExtension(
            'hcaptcha',
            function ($attribute, $value, $parameters) use ($secret) {
                return !empty($value) && (new hCaptcha($secret))->verify($value)->isSuccess();
            }
        );
    }
}
