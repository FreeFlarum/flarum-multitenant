<?php

namespace Blomstra\Spam;

use Flarum\Extend as Flarum;

return [
    (new Flarum\Event)
        ->subscribe(Filters\CommentPost::class)
        ->subscribe(Filters\Discussion::class)
        ->subscribe(Filters\UserBio::class)
];
