<?php

namespace ClarkWinkelmann\AuthorChange\Validators;

use Flarum\Foundation\AbstractValidator;

class TimeValidator extends AbstractValidator
{
    protected function getRules(): array
    {
        return [
            'time' => 'required|date',
        ];
    }
}
