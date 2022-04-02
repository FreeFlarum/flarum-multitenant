<?php

/*
 * This file is part of ianm/html-head.
 *
 * Copyright (c) 2021 IanM.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace IanM\HtmlHead;

use Flarum\Database\AbstractModel;

class Header extends AbstractModel
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'html_headers';
    
    /**
     * {@inheritdoc}
     */
    protected $dates = ['created_at', 'updated_at'];
}
