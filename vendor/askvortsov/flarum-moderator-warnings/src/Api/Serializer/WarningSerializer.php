<?php

/*
 * This file is part of askvortsov/flarum-moderator-warnings
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Askvortsov\FlarumWarnings\Api\Serializer;

use Askvortsov\FlarumWarnings\Model\Warning;
use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Api\Serializer\BasicUserSerializer;
use Flarum\Api\Serializer\PostSerializer;
use Flarum\Post\Post;

class WarningSerializer extends AbstractSerializer
{
    protected $type = 'warnings';

    /**
     * {@inheritdoc}
     */
    protected function getDefaultAttributes($warnings)
    {
        $attributes = [
            'id'               => $warnings->id,
            'userId'           => $warnings->user_id,
            'public_comment'   => $this->format($warnings->public_comment),
            'strikes'          => $warnings->strikes,
            'createdAt'        => $this->formatDate($warnings->created_at),
            'hiddenAt'         => $this->formatDate($warnings->hidden_at),
        ];

        if ($this->actor->can('user.manageWarnings')) {
            $attributes['private_comment'] = $this->format($warnings->private_comment);
        }

        return $attributes;
    }

    protected function format($text)
    {
        return Warning::getFormatter()->render($text, new Post());
    }

    protected function warnedUser($warnings)
    {
        return $this->hasOne($warnings, BasicUserSerializer::class);
    }

    protected function addedByUser($warnings)
    {
        return $this->hasOne($warnings, BasicUserSerializer::class);
    }

    protected function hiddenByUser($warnings)
    {
        return $this->hasOne($warnings, BasicUserSerializer::class);
    }

    protected function post($warnings)
    {
        return $this->hasOne($warnings, PostSerializer::class);
    }
}
