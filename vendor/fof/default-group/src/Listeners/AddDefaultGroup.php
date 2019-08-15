<?php

/*
 * This file is part of fof/default-group.
 *
 * Copyright (c) 2018 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace FoF\DefaultGroup\Listeners;

use Flarum\Group\Group;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\Event\Activated;

class AddDefaultGroup
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @param SettingsRepositoryInterface $settings
     */
    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function handle(Activated $event) {
        $defaultGroup = $this->settings->get('fof-default-group.group');

        if ($defaultGroup != null && (int) $defaultGroup !== Group::MEMBER_ID) {
            $event->user->groups()->attach($defaultGroup);
        }
    }
}
