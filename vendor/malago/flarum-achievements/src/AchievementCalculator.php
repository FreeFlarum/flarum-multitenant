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

use Flarum\User\User;
use Flarum\Post\Post;
use Illuminate\Support\Arr;
use Malago\Achievements\AchievementUser;

class AchievementCalculator
{

    public function recalculate(User $actor, $type_array)
    {

        $achievements = Achievement::all();

        $new_achievements=array();
        $removed_achievements=array();

        foreach($achievements as $ach){
            
            if($ach->getActive()){
                $split = explode(":",$ach->getComputation());
                if(count($split)==1){
                    $split=array($split[0],1);
                }
                foreach($type_array as $computation){

                    $type=$computation["type"];
                    $number=$computation["count"];
                    $user_id=$computation["user"]->getAttribute("id");

                    if(!array_key_exists($user_id,$new_achievements)){
                        $new_achievements[$user_id]=array();
                        $removed_achievements[$user_id]=array();
                    }

                    if($split[0]==$type){
                        $minmax=explode(",",$split[1]);

                        // app('log')->error(print_r($minmax,TRUE));
                        
                        if(count($minmax)==1){
                            if($number>=$minmax[0]){
                                array_push($new_achievements[$user_id], array($ach, $computation["new"]));
                            }else{
                                array_push($removed_achievements[$user_id], array($ach, $computation["new"]));
                            }
                        }else if(count($minmax)==2){
                            if($number>=$minmax[0] && $number<=$minmax[1]){
                                array_push($new_achievements[$user_id], array($ach, $computation["new"]));                          
                            } else {
                                array_push($removed_achievements[$user_id], array($ach, $computation["new"]));
                            }

                        }
                        break;
                    }
                    
                    if($type=="posts"){
                        if($split[0]=="contains"){
                            $minmax=explode(",",$split[1]);
                            $count =  Post::where('user_id', $user_id)->select('id')
                                ->whereRaw('LOWER(`content`) LIKE ? ',["%".strtolower($minmax[0])."%"])
                                ->get()->count();
                            if(count($minmax)==2){
                                if ($count>=$minmax[1]){
                                    array_push($new_achievements[$user_id], array($ach, $computation["new"]));
                                }else{
                                    array_push($removed_achievements[$user_id], array($ach, $computation["new"]));
                                }
                            }else if(count($minmax)==3){
                                if($count>=$minmax[1] && $count<=$minmax[2]){
                                    array_push($new_achievements[$user_id], array($ach, $computation["new"]));
                                }else{
                                    array_push($removed_achievements[$user_id], array($ach, $computation["new"]));
                                }
                            }
                            break;
                        }elseif($split[0]=="tagposts"){
                            $minmax=explode(",",$split[1]);
                            $count = Post::where('user_id', $user_id)
                                ->rightjoin('discussion_tag', 'posts.discussion_id', '=', 'discussion_tag.discussion_id')
                                ->leftjoin('tags', 'discussion_tag.tag_id', '=', 'tags.id')
                                ->groupBy("discussion_tag.tag_id")
                                ->where('slug',$minmax[0])->count();
                                
                            if(count($minmax)==2){
                                if($count>=$minmax[1]){
                                    array_push($new_achievements[$user_id], array($ach, $computation["new"]));
                                }else{
                                    array_push($removed_achievements[$user_id], array($ach, $computation["new"]));
                                }
                            }else if(count($minmax)==3){
                                if($count>=$minmax[1] && $count<=$minmax[2]){
                                    array_push($new_achievements[$user_id], array($ach, $computation["new"]));
                                }else{
                                    array_push($removed_achievements[$user_id], array($ach, $computation["new"]));
                                }
                            }
                            break;
                        }
                    }
                }
            }
        }

        $show_new_achievements=array();

        foreach($new_achievements as $key=>$achievements_user){
            foreach($achievements_user as $ach){
                $user = User::where('id',$key)->first();
                
                $check = AchievementUser::updateOrCreate([
                    "user_id"=>$user->id,
                    "achievement_id"=>$ach[0]->id
                    ],
                    [
                        "new"=>$ach[1],
                    ]
                );
                if($check->wasRecentlyCreated){
                    // new achievement
                    if($actor->id==$user->id)
                        array_push($show_new_achievements,$ach[0]->id);

                    AchievementUser::where("user_id",$user->id)
                            ->where("achievement_id",$ach[0]->id)
                            ->update(['created_at' => date('Y-m-d H:i:s'), "updated_at"=>date('Y-m-d H:i:s')]);
                }
            }
        }



        foreach($removed_achievements as $key=>$achievements_user){
            foreach($achievements_user as $ach){
                $user = User::where('id',$key)->first();
                
                $delete = AchievementUser::where('user_id',$user->id)->where("achievement_id",$ach[0]->id)->first();
                if($delete != NULL){
                    $delete->delete();
                }
            }
        }

        $ret = Achievement::select("name","description","image","rectangle")->whereIn("id",$show_new_achievements)->get();

        return $ret;
    }
}