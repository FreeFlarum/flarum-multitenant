<?php

namespace Justoverclock\Feedback\Api\Serializer;

use Flarum\Api\Serializer\AbstractSerializer;

class SubmitFeedbackSerializer extends AbstractSerializer
{
    protected $type = 'feedback';

    protected function getDefaultAttributes($model)
    {
        return [
            'email'        => $model->email,
            'feedbackType' => $model->feedbackType,
            'message'      => $model->message,
        ];
    }
}
