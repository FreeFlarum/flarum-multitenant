<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat\Commands;

use Flarum\User\User;

class PostEventMessage
{
    /**
     * The user performing the action.
     *
     * @var User
     */
    public $actor;

    /**
     * @var string
     */
    public $event_id;

    /**
     * @var string
     */
    public $ip_address;

    /**
     * @var EventMessageInterface
     */
    public $content;

    /**
     * @param User                      $actor
     * @param int                       $chat_id
     * @param EventMessageInterface     $content
     * @param string                    $ip_address
     */
    public function __construct($chat_id, User $actor, $event, string $ip_address)
    {
        $this->actor = $actor;
        $this->chat_id = $chat_id;
        $this->event = $event;
        $this->ip_address = $ip_address;
    }
}
