<?php

namespace ClarkWinkelmann\CatchTheFish\Validators;

use Flarum\Foundation\AbstractValidator;

class FishValidator extends AbstractValidator
{
    protected $rules = [
        'name' => 'required|string|min:3',
    ];
}
