<?php

/*
 * This file is part of sycho/flarum-move-posts.
 *
 * Copyright (c) 2021 Sami Mazouz.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SychO\MovePosts\Notification;

use Flarum\Discussion\Discussion;
use Flarum\Notification\Blueprint\BlueprintInterface;

class PostMovedBlueprint implements BlueprintInterface
{
    /**
     * @var Discussion
     */
    public $targetDiscussion;

    /**
     * @var Discussion
     */
    public $sourceDiscussion;

    public function __construct(Discussion $targetDiscussion, Discussion $sourceDiscussion)
    {
        $this->targetDiscussion = $targetDiscussion;
        $this->sourceDiscussion = $sourceDiscussion;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubject()
    {
        return $this->sourceDiscussion;
    }

    /**
     * {@inheritdoc}
     */
    public function getFromUser()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return [
            'targetDiscussionTitle' => $this->targetDiscussion->title,
            'targetDiscussionId' => $this->targetDiscussion->id,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'postMoved';
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubjectModel()
    {
        return Discussion::class;
    }
}
