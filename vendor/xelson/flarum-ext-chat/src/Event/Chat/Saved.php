<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Xelson\Chat\Event\Chat;

use Flarum\User\User;
use Xelson\Chat\Chat;

class Saved
{
    /**
     * The chat that was saved.
     *
     * @var Chat
     */
    public $chat;

    /**
     * The user who is performing the action.
     *
     * @var User
     */
    public $actor;

    /**
     * The attributes to update on the chat
     *
     * @var array
     */
    public $data;

    /**
     * Whether the chat was created
     *
     * @var bool
     */
    public $created;

    /**
     * @param Chat $chat
     * @param User $actor
     * @param array $data
     * @param bool $created
     */
    public function __construct(Chat $chat, User $actor, array $data, bool $created)
    {
        $this->chat = $chat;
        $this->actor = $actor;
        $this->data = $data;
        $this->created = $created;
    }
}
