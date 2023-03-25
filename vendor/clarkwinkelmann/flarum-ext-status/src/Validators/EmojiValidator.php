<?php

namespace ClarkWinkelmann\Status\Validators;

use Flarum\Foundation\AbstractValidator;
use Illuminate\Validation\Rule;

class EmojiValidator extends AbstractValidator
{
    protected $emojiFileName = 'all';

    public function onlyFlags()
    {
        $this->emojiFileName = 'flags';
    }

    protected function getRules()
    {
        $emojis = file_get_contents(__DIR__ . '/../../resources/emojis/' . $this->emojiFileName . '.json');

        return [
            'emoji' => [
                'nullable',
                'string',
                Rule::in(json_decode($emojis)),
            ]
        ];
    }
}
