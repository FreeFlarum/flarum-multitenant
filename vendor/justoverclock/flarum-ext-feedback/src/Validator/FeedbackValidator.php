<?php

namespace Justoverclock\Feedback\Validator;

use Flarum\Foundation\AbstractValidator;

class FeedbackValidator extends AbstractValidator
{
    /**
     * {@inheritdoc}
     */
    protected $rules = [
        'message' => ['required', 'string'],
    ];

    /**
     * {@inheritdoc}
     */
    protected function getMessages()
    {
        $error = resolve('translator')->trans('justoverclock-feedback.api.validation_error');

        return [
            'required' => $error,
        ];
    }
}