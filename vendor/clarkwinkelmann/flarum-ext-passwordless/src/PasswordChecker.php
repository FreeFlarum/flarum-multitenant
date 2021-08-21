<?php

namespace ClarkWinkelmann\PasswordLess;

use Flarum\Foundation\ValidationException;
use Flarum\Locale\Translator;
use Flarum\User\User;

class PasswordChecker
{
    protected $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function __invoke(User $user, string $passsword): ?bool
    {
        /**
         * @var Token $token
         */
        $token = Token::query()->where('user_id', $user->id)->where('token', $passsword)->first();

        if ($token) {
            if ($token->isExpired()) {
                throw new ValidationException([
                    'password' => [
                        $this->translator->trans('clarkwinkelmann-passwordless.api.expired-token-error'),
                    ],
                ]);
            }

            Token::deleteOldTokens();

            return true;
        }

        // If it's not a passwordless attempt, let the normal login process continue
        return null;
    }
}
