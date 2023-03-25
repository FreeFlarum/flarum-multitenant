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
use Flarum\Database\ScopeVisibilityTrait;
use Flarum\User\User;

class Achievement extends AbstractModel
{

    use ScopeVisibilityTrait;
    /**
     * {@inheritdoc}
     */
    protected $table = 'achievements';

    public static function build($name, $description="", $computation="", $points=0, $image="", $rectangle="0,0,0,0",$active=1,$hidden=0)
    {
        $achievement = new static();
        $achievement->name = $name;
        $achievement->description = $description;
        $achievement->computation = $computation;
        $achievement->points = $points;
        $achievement->image = $image;
        $achievement->rectangle = $rectangle;
        $achievement->active = $active;
        $achievement->hidden = $hidden;

        return $achievement;
    }

    public function getComputation(){
        return $this->computation;
    }

    public function getActive(){
        return $this->active;
    }

    public function getPoints(){
        return $this->points;
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'achievement_user')->withPivot("new");
    }

    public function save(array $options = [])
    {
        parent::save($options);
    }
}