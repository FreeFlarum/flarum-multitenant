<?php

namespace ClarkWinkelmann\PasswordLess;

use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Extend;
use Flarum\User\Event\Saving;
use Flarum\User\UserValidator;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    (new Extend\Routes('forum'))
        ->get('/passwordless-login', 'clarkwinkelmann.passwordless', Controllers\LoginFromTokenController::class),

    (new Extend\Routes('api'))
        ->post('/passwordless-request', 'clarkwinkelmann.passwordless', Controllers\RequestTokenController::class),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\View())
        ->namespace('passwordless', __DIR__ . '/resources/views'),

    (new Extend\ApiSerializer(ForumSerializer::class))
        ->attributes(ForumAttributes::class),

    (new Extend\Event())
        ->listen(Saving::class, Listeners\SaveUser::class),

    (new Extend\Auth())
        ->addPasswordChecker('passwordless', PasswordChecker::class),

    (new Extend\Validator(UserValidator::class))
        ->configure(MakePasswordOptional::class),
];
