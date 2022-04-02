<?php

/*
 * This file is part of datlechin/flarum-keyboard-shortcuts.
 *
 * Copyright (c) 2021 Ngo Quoc Dat.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Datlechin\KeyboardShortcuts\Listeners;

use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Settings\SettingsRepositoryInterface;

class LoadSettingsFromDatabase
{
    /**
     * @var string
     */
    protected $packagePrefix = 'datlechin-keyboard-shortcuts.';
    /**
     * @var array
     */
    protected $fieldsToGet = [
        'help',
        'search',
        'newDiscussion',
        'notifications',
        'flags',
        'session',
        'login',
        'signup',
        'back',
        'pinNav',
        'reply',
        'follow',
        'firstPost',
        'lastPost',
        'markAllAsRead',
        'refresh',
    ];

    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * LoadSettingsFromDatabase constructor.
     *
     * @param SettingsRepositoryInterface $settings
     */
    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(): array
    {
        $attributes = [];

        foreach ($this->fieldsToGet as $field) {
            $value = $this->settings->get($this->packagePrefix . $field);

            if (isset($value) && !empty($value)) {
                $attributes[$this->packagePrefix . $field] = $this->settings->get($this->packagePrefix . $field);
            }
        }

        return $attributes;
    }
}
