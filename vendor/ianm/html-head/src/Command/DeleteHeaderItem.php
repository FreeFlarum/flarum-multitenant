<?php

/*
 * This file is part of ianm/html-head.
 *
 * Copyright (c) 2021 IanM.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace IanM\HtmlHead\Command;

use Flarum\User\User;

class DeleteHeaderItem
{
    /**
     * The user performing the action.
     *
     * @var User
     */
    public $actor;

    /**
     * The ID of the header.
     *
     * @var int
     */
    public $headerId;

    /**
     * DeleteHeaderItem constructor.
     *
     * @param User $actor
     * @param $headerId
     */
    public function __construct(User $actor, $headerId)
    {
        $this->actor = $actor;
        $this->headerId = $headerId;
    }
}
