<?php

/*
 * This file is part of sycho/flarum-move-posts.
 *
 * Copyright (c) 2021 Sami Mazouz.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SychO\MovePosts\Access;

use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class GlobalPolicy extends AbstractPolicy
{
    public function movePosts(User $actor)
    {
        return $actor->hasPermission('sycho-move-posts:movePosts');
    }
}
