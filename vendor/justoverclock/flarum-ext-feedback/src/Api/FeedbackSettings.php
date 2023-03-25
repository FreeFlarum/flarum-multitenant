<?php

namespace Justoverclock\Feedback\Api;

use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Support\Arr;

class FeedbackSettings
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }
    
    public function __invoke(ForumSerializer $serializer, $model, array $attributes): array
    {
        // Check we have a destination to send feedback to, otherwise we don't
        // show the feedback widget
        if (!empty($this->settings->get('justoverclock-feedback.ContactMail'))) {
            $attributes = Arr::add($attributes, 'feedback.email', (bool) $this->settings->get('justoverclock-feedback.collect-email', false));
            $attributes = Arr::add($attributes, 'feedback.position', (string) $this->settings->get('justoverclock-feedback.position', 'right'));
            $attributes = Arr::add($attributes, 'feedback.backgroundColor', (string) $this->settings->get('justoverclock-feedback.backgroundColor', '#fff'));
            $attributes = Arr::add($attributes, 'feedback.fontColor', (string) $this->settings->get('justoverclock-feedback.fontColor', '#000'));
        }

        return $attributes;
    }
}