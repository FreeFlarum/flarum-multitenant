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

class UpdateHeaderItem
{
    /**
     * The ID of the header item.
     *
     * @var int
     */
    public $headerId;

    /**
     * The user performing the action.
     *
     * @var User
     */
    public $actor;

    /**
     * The attributes of the header item.
     *
     * @var array
     */
    public $data;

    /**
     * UpdateHeaderItem constructor.
     *
     * @param $headerId
     * @param User  $actor
     * @param array $data
     */
    public function __construct(User $actor, $headerId, array $data)
    {
        $this->actor = $actor;
        $this->headerId = $headerId;
        $this->data = $data;
    }
}
