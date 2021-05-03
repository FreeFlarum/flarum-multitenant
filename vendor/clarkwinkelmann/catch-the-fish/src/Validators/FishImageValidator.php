<?php

namespace ClarkWinkelmann\CatchTheFish\Validators;

use Flarum\Foundation\AbstractValidator;

class FishImageValidator extends AbstractValidator
{
    protected $rules = [
        'image' => 'required|mimes:jpeg,png,bmp,gif|max:2048',
    ];
}
