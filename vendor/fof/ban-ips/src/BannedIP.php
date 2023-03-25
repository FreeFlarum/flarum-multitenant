<?php

/*
 * This file is part of fof/ban-ips.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\BanIPs;

use Carbon\Carbon;
use Flarum\Database\AbstractModel;
use Flarum\User\User;

/**
 * @property User        $creator
 * @property User        $user
 * @property int         $id
 * @property int         $creator_id
 * @property int         $user_id
 * @property string      $address
 * @property string|null $reason
 * @property Carbon|null $created_at
 * @property Carbon|null $deleted_at
 */
class BannedIP extends AbstractModel
{
    /**
     * @var string
     */
    protected $table = 'banned_ips';

    /**
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at'];

    /**
     * @param $creatorId
     * @param $userId
     * @param $address
     * @param null $reason
     *
     * @return BannedIP
     */
    public static function build($creatorId, $userId, $address, $reason = null)
    {
        $banIP = new static();

        $banIP->creator_id = $creatorId;
        $banIP->user_id = $userId;
        $banIP->address = $address;
        $banIP->reason = $reason;

        return $banIP;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
