<?php

/*
 * This file is part of malago/achievements
 *
 *  Copyright (c) 2021 Miguel A. Lago
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Malago\Achievements;

use Flarum\Database\AbstractModel;
use Flarum\User\User;

class AchievementUser extends AbstractModel
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'achievement_user';

    protected $fillable = ['user_id','achievement_id','created_at'];

    public static function build($user_id, $achievement_id, $new = 0)
    {
        $achievement = new static();
        $achievement->user_id = $user_id;
        $achievement->achievement_id = $achievement_id;
        $achievement->created_at = date('Y-m-d H:i:s');
        $achievement->new = $new;

        return $achievement;
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}