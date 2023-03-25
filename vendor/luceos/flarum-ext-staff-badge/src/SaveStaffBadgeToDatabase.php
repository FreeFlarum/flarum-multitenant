<?php

namespace Serakoi\FlarumStaffBadge;

use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\Event\Saving;
use Flarum\User\Exception\PermissionDeniedException;
use Illuminate\Support\Arr;

class SaveStaffBadgeToDatabase {
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings) {
        $this->settings = $settings;
    }

    public function handle(Saving $event)
    {
        $user = $event->user;
        $data = $event->data;
        $actor = $event->actor;
        $attributes = Arr::get($data, 'attributes', []);

        if (isset($attributes['staffBadge'])) {
            $actor->assertAdmin();
            $staffbadge = $attributes['staffBadge'];

            //? Set staff badge to true or false
            if($staffbadge === "true"){
                $user->staffbadge = "true";
            } else {
                $user->staffbadge = "false";
            }
        }
        if (isset($attributes['tagList'])) {
            $actor->assertAdmin();
            $tagList = $attributes['tagList'];

            //? Set tagList for user, seperated by coma
            $user->tagList = $tagList;
        }
    }
}