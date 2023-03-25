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

class Deleting
{
    /**
     * The chat that is going to be deleted.
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
     * @param Chat $chat
     * @param User $actor
     */
    public function __construct(Chat $chat, User $actor)
    {
        $this->chat = $chat;
        $this->actor = $actor;
    }
}
