<?php

/*
 * This file is part of sycho/flarum-move-posts.
 *
 * Copyright (c) 2021 Sami Mazouz.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SychO\MovePosts;

use Flarum\Foundation\AbstractValidator;

class MovePostsValidator extends AbstractValidator
{
    protected $rules = [
        'sourceDiscussionId' => 'required|integer',
        'postIds' => 'required|array',
        'postIds.*' => 'required|integer',
        'targetDiscussionId' => 'required_without:newDiscussion|integer',
        'newDiscussion' => 'sometimes',
        'newDiscussionTitle' => 'required_with:newDiscussion|string',
    ];
}
