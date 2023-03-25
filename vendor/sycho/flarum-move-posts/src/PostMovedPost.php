<?php

/*
 * This file is part of sycho/flarum-move-posts.
 *
 * Copyright (c) 2021 Sami Mazouz.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SychO\MovePosts;

use Carbon\Carbon;
use Flarum\Discussion\Discussion;
use Flarum\Post\Post;
use Flarum\Post\AbstractEventPost;
use Flarum\Post\MergeableInterface;
use Flarum\Settings\SettingsRepositoryInterface;

class PostMovedPost extends AbstractEventPost implements MergeableInterface
{
    public static $type = 'postMoved';

    public function saveAfter(Post $previous = null)
    {
        $groupSequentialPosts = resolve(SettingsRepositoryInterface::class)->get('sycho-move-posts.group_sequential_event_posts');

        // If the previous post is another 'post moved' post, and it's
        // by the same user, and sequential posts is on, then we can merge this post into it.
        if ($groupSequentialPosts && $previous instanceof static && $this->user_id === $previous->user_id) {
            $previous->content = static::buildContent(
                $previous->content['targetDiscussionId'],
                $previous->content['targetDiscussionTitle'],
                $previous->content['count'] + $this->content['count'],
                $previous->content['number'],
                $previous->content['originalPostId']
            );
            $previous->save();

            return $previous;
        }

        $this->save();

        return $this;
    }

    public static function reply(int $discussionId, int $userId, Discussion $targetDiscussion, Post $movedPost, Post $oldPost, int $count = 1)
    {
        $post = new static;

        $post->content = static::buildContent($targetDiscussion->id, $targetDiscussion->title, $count, $movedPost->number, $movedPost->id);
        $post->created_at = $movedPost->created_at;
        $post->discussion_id = $discussionId;
        $post->user_id = $userId;
        $post->number = $oldPost->number;
        $post->type = static::$type;

        return $post;
    }

    protected static function buildContent(int $targetDiscussionId, string $targetDiscussionTitle, int $count, int $number, int $originalPostId)
    {
        return compact('targetDiscussionId', 'targetDiscussionTitle', 'count', 'number', 'originalPostId');
    }
}
