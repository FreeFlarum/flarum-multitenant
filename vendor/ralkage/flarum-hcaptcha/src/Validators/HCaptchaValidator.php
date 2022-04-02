<?php

/*
 * This file is part of ralkage/flarum-hcaptcha.
 *
 * Copyright (c) Christian Lopez.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ralkage\HCaptcha\Validators;

use Flarum\Foundation\AbstractValidator;

class HCaptchaValidator extends AbstractValidator
{
    /**
     * {@inheritdoc}
     */
    protected $rules = [
        'hcaptcha' => [
            'required',
            'hcaptcha',
        ],
    ];
}
