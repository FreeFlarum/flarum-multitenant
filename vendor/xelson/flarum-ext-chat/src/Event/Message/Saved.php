<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Xelson\Chat\Event\Message;

use Flarum\User\User;
use Xelson\Chat\Message;

class Saved
{
    /**
     * The message that is going to be saved.
     *
     * @var Message
     */
    public $message;

    /**
     * The user who is performing the action.
     *
     * @var User
     */
    public $actor;

    /**
     * The attributes to update on the message
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
     * @param Message $message
     * @param User $actor
     * @param array $data
     * @param bool $created
     */
    public function __construct(Message $message, User $actor, array $data, bool $created)
    {
        $this->message = $message;
        $this->actor = $actor;
        $this->data = $data;
        $this->created = $created;
    }
}
