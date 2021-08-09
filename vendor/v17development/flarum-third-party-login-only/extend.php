<?php

namespace V17Development\FlarumThirdPartyLoginOnly;

use Flarum\Extend;

return [
    // Forum
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__ . '/less/Forum.less'),

    // Admin
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    // Disable default authenticating endpoints
    (new Extend\Routes('forum'))
        ->remove('login')
        ->post('/login', 'login.disabled', Api\ApiRouteDisabledController::class)

        // Disable password reset
        ->remove('savePassword')
        ->post('/reset', 'savePassword.disabled', Controller\RouteDisabledController::class)

        // Disable password reset token validation
        ->remove('resetPassword')
        ->get('/reset/{token}', 'resetPassword.disabled', Api\ApiRouteDisabledController::class),

    // Remove api endpoints
    (new Extend\Routes('api'))
        ->remove('forgot')
        ->post('/forgot', 'forgot.disabled', Api\ApiRouteDisabledController::class)

        ->remove('users.create')
        ->post('/users', 'users.create', Api\CreateUserController::class),

    // Register settings to forum
    (new Extend\Settings)
        ->serializeToForum('forgotPasswordLink', 'v17development-third-party-login-only.forgotPasswordLink', null, "")
        ->serializeToForum('replaceLoginWithFoFPassport', 'v17development-third-party-login-only.replaceLoginWithFoFPassport', null, false)
        ->serializeToForum('changePasswordLink', 'v17development-third-party-login-only.changePasswordLink', null, "")
        ->serializeToForum('allowChangeMail', 'v17development-third-party-login-only.allowChangeMail', null, false)
        ->serializeToForum('signUpWelcomeText', 'v17development-third-party-login-only.signUpWelcomeText', null, "")
];
