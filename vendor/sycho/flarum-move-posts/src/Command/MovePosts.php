<?php

/*
 * This file is part of sycho/flarum-move-posts.
 *
 * Copyright (c) 2021 Sami Mazouz.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SychO\MovePosts\Command;

use Flarum\User\User;

class MovePosts
{
    /**
     * @var \Flarum\User\User
     */
    public $actor;

    /**
     * @var array
     */
    public $data;

    /**
     * @var bool
     */
    public $emulate;

    public function __construct(User $actor, array $data, bool $emulate)
    {
        $this->actor = $actor;
        $this->data = $data;
        $this->emulate = $emulate;
    }
}
