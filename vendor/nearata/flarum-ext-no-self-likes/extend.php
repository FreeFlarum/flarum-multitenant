<?php

namespace Nearata\NoSelfLikes;

use Flarum\Extend;
use Flarum\Post\Post;

return [
    (new Extend\Policy())
        ->modelPolicy(Post::class, PostPolicy::class)
];
