<?php

/*
 * This file is part of sycho/flarum-move-posts.
 *
 * Copyright (c) 2021 Sami Mazouz.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SychO\MovePosts\Exception;

use Exception;
use Flarum\Foundation\KnownError;

class MoveOldPostToNewerDiscussionException extends Exception implements KnownError
{
    public function __construct()
    {
        parent::__construct('Cannot move old post to a newer discussion.');
    }

    public function getType(): string
    {
        return 'move_old_post_to_newer_discussion';
    }
}
