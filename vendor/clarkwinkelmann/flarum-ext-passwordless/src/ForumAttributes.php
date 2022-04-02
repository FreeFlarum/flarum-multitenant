<?php

namespace ClarkWinkelmann\PasswordLess;

use Flarum\Settings\SettingsRepositoryInterface;

class ForumAttributes
{
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(): array
    {
        return [
            'passwordless.passwordlessLoginByDefault' => (bool)$this->settings->get('passwordless.passwordlessLoginByDefault', true),
            'passwordless.hideSignUpPassword' => (bool)$this->settings->get('passwordless.hideSignUpPassword', true),
        ];
    }
}
