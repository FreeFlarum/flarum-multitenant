<?php

/*
 * This file is part of askvortsov/flarum-moderator-warnings
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Askvortsov\FlarumWarnings\Model;

use Flarum\Database\AbstractModel;
use Flarum\Database\ScopeVisibilityTrait;
use Flarum\Formatter\Formatter;
use Flarum\Post\Post;
use Flarum\User\User;

/**
 * @property Date
 * @property User addedByUser
 */
class Warning extends AbstractModel
{
    use ScopeVisibilityTrait;

    protected $table = 'warnings';

    protected $dates = ['created_at', 'hidden_at'];

    /**
     * The text formatter instance.
     *
     * @var \Flarum\Formatter\Formatter
     */
    protected static $formatter;

    /**
     * Get the text formatter instance.
     *
     * @return \Flarum\Formatter\Formatter
     */
    public static function getFormatter()
    {
        return static::$formatter;
    }

    /**
     * Set the text formatter instance.
     *
     * @param \Flarum\Formatter\Formatter $formatter
     */
    public static function setFormatter(Formatter $formatter)
    {
        static::$formatter = $formatter;
    }

    public function warnedUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function addedByUser()
    {
        return $this->hasOne(User::class, 'id', 'created_user_id');
    }

    public function hiddenByUser()
    {
        return $this->hasOne(User::class, 'id', 'hidden_user_id');
    }

    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }

    public static function strikesForUser($user)
    {
        return self::where('user_id', $user->id)->get()->filter(function ($warning) {
            return is_null($warning->hidden_at);
        })->map(function ($warning) {
            return $warning->strikes;
        })->sum();
    }
}
