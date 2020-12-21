<?php

/*
 * This file is part of fof/prevent-necrobumping.
 *
 * Copyright (c) 2020 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace FoF\PreventNecrobumping\Listeners;

use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Discussion\Discussion;
use Flarum\Settings\SettingsRepositoryInterface;

class AddForumAttributes
{
    /**
     * @var SettingsRepositoryInterface
     */
    private $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(DiscussionSerializer $serializer, Discussion $discussion, array $attributes): array
    {
        $attributes['fof-prevent-necrobumping'] = $this->getDays($discussion);

        return $attributes;
    }

    /**
     * @param \Flarum\Discussion\Discussion $discussion
     *
     * @return int
     */
    protected function getDays($discussion)
    {
        $days = $this->settings->get('fof-prevent-necrobumping.days');
        $tags = $discussion->tags;

        if ($tags && $tags->isNotEmpty()) {
            $tagDays = $tags->map(function ($tag) {
                return $this->settings->get("fof-prevent-necrobumping.days.tags.{$tag->id}");
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
