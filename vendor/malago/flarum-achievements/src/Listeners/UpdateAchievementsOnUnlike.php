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
use Flarum\Likes\Event\PostWasLiked;
use Flarum\Likes\Event\PostWasUnliked;
use Flarum\Post\Post;
use Flarum\User\User;

class UpdateAchievementsOnUnlike
{
    protected $calculator;

    public function __construct(AchievementCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function extensionDependencies(): array
    {
        return ['flarum-likes'];
    }

    public function handle(PostWasUnliked $event)
    {
        $arr = array(
            array(
                "type"=>"likes",
                "count"=>User::where("id","=",$event->actor->id)->join('post_likes', 'users.id', '=', 'post_likes.user_id')->count(),
                "user"=>$event->actor,
                "new"=>0,
            ),
        );
        
        $event->actor["new_achievements"] = $this->calculator->recalculate($event->actor,$arr);

        $arr = array(
            array(
                "type"=>"selflikes",
                "count"=>Post::where('user_id', $event->post->user_id)->select('id')->withCount('likes')->get()->sum('likes_count'),
                "user"=>$event->post->user,
                "new"=>1,
            )
        );

        $this->calculator->recalculate($event->post->user,$arr);
    }
}