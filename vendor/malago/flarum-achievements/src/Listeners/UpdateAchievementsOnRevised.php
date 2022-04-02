<?php

/*
 * This file is part of malago/achievements
 *
 *  Copyright (c) 2021 Miguel A. Lago
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Malago\Achievements\Listeners;

use Malago\Achievements\AchievementCalculator;
use Flarum\Post\Event\Revised;
use Flarum\Post\Post;

class UpdateAchievementsOnRevised
{

    protected $calculator;

    public function __construct(AchievementCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function handle(Revised $event)
    {

        $arr = array(
            array(
                "type"=>"edits",
                "count"=>Post::where('user_id', $event->actor->user_id)->select('id')->whereNotNull('edited_at')->get()->count(),
                "user"=>$event->actor,
                "new"=>0,
            )
        );

        $event->actor["new_achievements"] = $this->calculator->recalculate($event->actor,$arr);
    }
}