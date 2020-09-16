<?php

/*
 * This file is part of fof/prevent-necrobumping.
 *
 * Copyright (c) 2018 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace FoF\PreventNecrobumping\Listeners;

use Carbon\Carbon;
use Flarum\Api\Event\Serializing;
use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Discussion\Discussion;
use Flarum\Post\Event\Saving;
use Flarum\Settings\SettingsRepositoryInterface;
use FoF\PreventNecrobumping\Validators\NecrobumpingPostValidator;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Arr;

class ValidateNecrobumping
{
    protected $validator;
    /**
     * @var SettingsRepositoryInterface
     */
    private $settings;

    public function __construct(NecrobumpingPostValidator $validator, SettingsRepositoryInterface $settings)
    {
        $this->validator = $validator;
        $this->settings = $settings;
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(Saving::class, [$this, 'saving']);
        $events->listen(Serializing::class, [$this, 'serializing']);
    }

    public function saving(Saving $event)
    {
        if ($event->post->exists || $event->post->number == 1) {
            return;
        }

        $lastPostedAt = $event->post->discussion->last_posted_at;
        $days = $this->getDays($event->post->discussion);

        if ($lastPostedAt && $days && $lastPostedAt->diffInDays(Carbon::now()) >= $days) {
            $this->validator->assertValid([
                'fof-necrobumping' => Arr::get($event->data, 'attributes.fof-necrobumping'),
            ]);
        }
    }

    public function serializing(Serializing $event)
    {
        if ($event->isSerializer(DiscussionSerializer::class)) {
            $event->attributes['fof-prevent-necrobumping'] = $this->getDays($event->model);
        }
    }

    /**
     * @param Discussion $discussion
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
