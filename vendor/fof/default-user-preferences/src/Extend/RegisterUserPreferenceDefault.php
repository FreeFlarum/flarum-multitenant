<?php

/*
 * This file is part of fof/default-user-preferences.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\DefaultUserPreferences\Extend;

use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

class RegisterUserPreferenceDefault implements ExtenderInterface
{
    protected $data = [];

    /**
     * Includes this user preference option in `fof/default-user-preferences`.
     *
     * `type` must be specified as any valid `<input>` type (except `select`), as this will be used for construct the settings options.
     *
     * @param string $key
     * @param mixed  $value
     * @param string $type
     *
     * @return self
     */
    public function default(string $key, $value, string $type)
    {
        $this->data[] = compact('key', 'value', 'type');

        return $this;
    }

    public function extend(Container $container, Extension $extension = null)
    {
        $container->extend('fof-default-user-preferences', function ($items) {
            return array_merge($items, $this->data);
        });
    }
}
