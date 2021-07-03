<?php

/*
 * This file is part of fof/prevent-necrobumping.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\PreventNecrobumping;

use Flarum\Discussion\Discussion;
use Flarum\Settings\SettingsRepositoryInterface;

class Util
{
    public static function getDays(SettingsRepositoryInterface $settings, Discussion $discussion): ?int
    {
        $days = $settings->get('fof-prevent-necrobumping.days');
        $tags = $discussion->tags;

        if ($tags && $tags->isNotEmpty()) {
            $tagDays = $tags->map(function ($tag) use ($settings) {
                return $settings->get("fof-prevent-necrobumping.days.tags.{$tag->id}");
            })->filter(function ($days) {
                return $days != null && $days != '' && !is_nan($days) && (int) $days >= 0;
            });

            if ($tagDays->isNotEmpty()) {
                $days = $tagDays->contains(0)
                    ? null
                    : $tagDays->min();
            }
        }

        return is_nan($days) || $days < 1 ? null : (int) $days;
    }
}
