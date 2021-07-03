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
use Flarum\Post\Event\Posted;
use Flarum\Post\Post;
use Flarum\Discussion\Discussion;

class UpdateAchievementsOnPost
{

    protected $calculator;

    public function __construct(AchievementCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function handle(Posted $event)
    {
        $DB=Post::query()->getConnection();
        $meanwords=$DB->select("select sum(my_length)/count(user_id) as mean from (SELECT user_id, length(content) - LENGTH(REPLACE(content,' ','')) as my_length FROM ".($DB->getTablePrefix())."".(app(Post::class)->getTable())." where user_id=".($event->post->user_id)." and type='comment') as Q1 where my_length > 10");

        $arr = array(
            array(
                "type"=>"posts",
                "count"=>$event->post->user->comment_count,
                "user"=>$event->post->user,
                "new"=>0,
            ),
            array(
                "type"=>"meanwords",
                "count"=> $meanwords[0]->mean,
                "user"=>$event->post->user,
                "new"=>0,
            ),
            array(
                "type"=>"comments",
                "count"=>Discussion::where("user_id","=",$event->post->discussion->user_id)->max("comment_count"),
                "user"=>$event->post->discussion->user,
                "new"=>1,
            ),
        );

        $event->actor["new_achievements"] = $this->calculator->recalculate($event->post->user,$arr);			

    }
}