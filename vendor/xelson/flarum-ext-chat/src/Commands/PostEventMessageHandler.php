<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat\Commands;

use Carbon\Carbon;
use Xelson\Chat\ChatRepository;
use Xelson\Chat\Message;

class PostEventMessageHandler
{
    /**
     * @param ChatRepository        $chats
     */
    public function __construct(ChatRepository $chats) 
    {
        $this->chats = $chats;
    }

    /**
     * Handles the command execution.
     *
     * @param PostMessage $command
     * @return null|string
     */
    public function handle(PostEventMessage $command)
    {
        $actor = $command->actor;
        $chat_id = $command->chat_id;
        $eventInstance = $command->event;
        $ip_address = $command->ip_address;

        $chat = $this->chats->findOrFail($chat_id, $actor);
        $content = $eventInstance->content();

        $message = Message::build(
            $content,
            $actor->id,
            Carbon::now(),
            $chat->id,
			$ip_address,
			1
        );

        $message->save();

        return $message;
    }
}
