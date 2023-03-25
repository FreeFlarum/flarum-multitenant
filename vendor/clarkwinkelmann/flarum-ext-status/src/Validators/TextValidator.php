<?php

namespace ClarkWinkelmann\Status\Validators;

use Flarum\Foundation\AbstractValidator;

class TextValidator extends AbstractValidator
{
    protected $rules = [
        'text' => 'nullable|string|max:250',
    ];
}
