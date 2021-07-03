<?php

/*
 * This file is part of fof/username-request.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\UserRequest\Api\Serializer;

use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Api\Serializer\BasicUserSerializer;

class RequestSerializer extends AbstractSerializer
{
    /**
     * {@inheritdoc}
     */
    protected $type = 'username-requests';

    /**
     * {@inheritdoc}
     */
    protected function getDefaultAttributes($username_request)
    {
        return [
            'requestedUsername'  => $username_request->requested_username,
            'status'             => $username_request->status,
            'reason'             => $username_request->reason,
            'createdAt'          => $this->formatDate($username_request->created_at),
            'forNickname'        => $username_request->for_nickname,
        ];
    }

    /**
     * @param $username_request
     *
     * @return \Tobscure\JsonApi\Relationship
     */
    protected function user($username_request)
    {
        return $this->hasOne($username_request, BasicUserSerializer::class);
    }
}
