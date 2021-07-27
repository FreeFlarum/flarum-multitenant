<?php

/*
 * This file is part of malago/achievements
 *
 *  Copyright (c) 2021 Miguel A. Lago
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Malago\Achievements\Api\Serializers;

use Flarum\Api\Serializer\AbstractSerializer;
use Malago\Achievements\AchievementUser;
use Malago\Achievements\Achievement;

class AchievementUserSerializer extends AbstractSerializer
{
    /**
     * @var string
     */
    protected $type = 'achievement_user';

    /**
     * @param $group
     *
     * @return array
     */
    protected function getDefaultAttributes($ach)
    {
        if (!($ach instanceof AchievementUser)) {
            throw new InvalidArgumentException(
                get_class($this).' can only serialize instances of '.AchievementUser::class
            );
        }

        $achievement = Achievement::find($ach->achievement_id);

        return [
            'id' => $ach->achievement_id,
            'name' => $achievement->name,
            'description'   => $achievement->description,
            'computation'   => $achievement->computation,
            'points'   => $achievement->points,
            'image'   => $achievement->image,
            'rectangle'   => $achievement->rectangle,
            'active'   => $achievement->active,
            'hidden'   => $achievement->hidden,
            'created_at' => $ach->created_at,
            'new' => $ach->new
        ];
    }
}