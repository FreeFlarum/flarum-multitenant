<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat\Commands;

use Illuminate\Contracts\Events\Dispatcher;
use Xelson\Chat\ChatRepository;
use Xelson\Chat\Event\Message\Deleting;
use Xelson\Chat\MessageRepository;

class DeleteMessageHandler
{
    /**
     * @var MessageRepository
     */
    protected $messages;

    /**
     * @param MessageRepository $messages
     * @param ChatRepository $chats
     * @param Dispatcher $events
     */
    public function __construct(MessageRepository $messages, ChatRepository $chats, Dispatcher $events)
    {
        $this->messages  = $messages;
        $this->chats = $chats;
        $this->events = $events;
    }

    /**
     * Handles the command execution.
     *
     * @param DeleteMessage $command
     * @return null|string
     */
    public function handle(DeleteMessage $command)
    {
        $messageId = $command->id;
        $actor = $command->actor;

        $message = $this->messages->findOrFail($messageId);

        $actor->assertPermission(
            !$message->type
        );

        $chat = $this->chats->findOrFail($message->chat_id, $actor);
        $chatUser = $chat->getChatUser($actor);

        $actor->assertPermission(
            $chatUser && $chatUser->role != 0
        );

        $this->events->dispatch(
            new Deleting($message, $actor)
        );

        $message->delete();
        $message->deleted_by = $actor->id;
        $message->deleted_forever = true;

        return $message;
    }
}
