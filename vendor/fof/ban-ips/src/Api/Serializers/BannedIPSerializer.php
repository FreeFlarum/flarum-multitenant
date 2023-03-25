<?php

/*
 * This file is part of fof/ban-ips.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\BanIPs\Api\Serializers;

use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Api\Serializer\BasicUserSerializer;
use FoF\BanIPs\BannedIP;
use InvalidArgumentException;

class BannedIPSerializer extends AbstractSerializer
{
    /**
     * @var string
     */
    protected $type = 'banned_ips';

    /**
     * @param array|BannedIP $bannedIP
     *
     * @return array
     */
    protected function getDefaultAttributes($bannedIP)
    {
        if (!($bannedIP instanceof BannedIP)) {
            throw new InvalidArgumentException(
                get_class($this).' can only serialize instances of '.BannedIP::class
            );
        }

        return [
            'id'        => $bannedIP->id,
            'creatorId' => $bannedIP->creator_id,
            'userId'    => $bannedIP->user_id,
            'address'   => $bannedIP->address,
            'reason'    => $bannedIP->reason,
            'createdAt' => $this->formatDate($bannedIP->created_at),
        ];
    }

    /**
     * @param $bannedIP
     *
     * @return \Tobscure\JsonApi\Relationship
     */
    protected function creator($bannedIP)
    {
        return $this->hasOne($bannedIP, BasicUserSerializer::class, 'creator');
    }

    /**
     * @param $bannedIP
     *
     * @return \Tobscure\JsonApi\Relationship
     */
    protected function user($bannedIP)
    {
        return $this->hasOne($bannedIP, BasicUserSerializer::class, 'user');
    }
}
