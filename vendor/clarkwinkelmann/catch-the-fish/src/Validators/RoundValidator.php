<?php

namespace ClarkWinkelmann\CatchTheFish\Validators;

use Flarum\Foundation\AbstractValidator;

class RoundValidator extends AbstractValidator
{
    protected $rules = [
        'name' => 'required|string',
        'starts_at' => 'nullable|date',
        'ends_at' => 'required|date',
    ];
}
