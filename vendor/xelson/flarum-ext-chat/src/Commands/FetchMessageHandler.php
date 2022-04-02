<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat\Commands;

use Xelson\Chat\ChatRepository;
use Xelson\Chat\MessageRepository;

class FetchMessageHandler
{
    /**
     * @var MessageRepository
     */
    protected $messages;

    /**
     * @param MessageRepository             $messages
     * @param ChatRepository                $chats
     */
    public function __construct(
        MessageRepository $messages,
        ChatRepository $chats) 
    {
        $this->messages  = $messages;
        $this->chats = $chats;
    }

    /**
     * Handles the command execution.
     *
     * @return null|string
     *
     */
    public function handle(FetchMessage $command)
    {
        $actor = $command->actor;
        $query = $command->query;
 
        $chat = $this->chats->findOrFail($command->chat_id, $actor);

        if(is_array($query)) $messages = $this->messages->queryVisible($chat, $actor)->whereIn('id', $query)->get();
        else $messages = $this->messages->fetch($query, $actor, $chat);

        return $messages;
    }
}
