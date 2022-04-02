<?php

/*
 * This file is part of ianm/html-head.
 *
 * Copyright (c) 2021 IanM.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace IanM\HtmlHead\Api\Serializers;

use Flarum\Api\Serializer\AbstractSerializer;

class HeaderSerializer extends AbstractSerializer
{
    /**
     * {@inheritdoc}
     */
    protected $type = 'html-headers';

    /**
     * {@inheritdoc}
     */
    protected function getDefaultAttributes($header)
    {
        return [
            'id'            => $header->id,
            'description'   => $header->description,
            'header'        => $header->header,
            'active'        => (bool) $header->active,
        ];
    }
}
