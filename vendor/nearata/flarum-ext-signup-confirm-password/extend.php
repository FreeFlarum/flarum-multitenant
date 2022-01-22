<?php

namespace Nearata\SignUpConfirmPassword;

use Flarum\Extend;
use Flarum\User\Event\Saving;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js'),
    new Extend\Locales(__DIR__ . '/resources/locale'),
    (new Extend\Event)
        ->listen(Saving::class, ValidatePassword::class)
];
