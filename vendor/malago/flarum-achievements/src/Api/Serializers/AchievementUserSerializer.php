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

        return [
            'achievement_id' => $ach->achievement_id,
            'user_id'   => $ach->user_id,
            'created_at' => $ach->created_at,
            'new' => $ach->new
        ];
    }
}