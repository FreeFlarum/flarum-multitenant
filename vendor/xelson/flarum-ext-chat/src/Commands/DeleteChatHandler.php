<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat\Commands;

use Xelson\Chat\ChatRepository;
use Illuminate\Contracts\Bus\Dispatcher as BusDispatcher;
use Illuminate\Contracts\Events\Dispatcher;
use Xelson\Chat\Event\Chat\Deleting;

class DeleteChatHandler
{
    /**
     * @param ChatRepository $chats
     * @param ChatSocket $socket
     * @param Dispatcher $events
     */
    public function __construct(ChatRepository $chats, BusDispatcher $bus, Dispatcher $events)
    {
        $this->chats  = $chats;
        $this->bus = $bus;
        $this->events = $events;
    }

    /**
     * Handles the command execution.
     *
     * @param DeleteChat $command
     * @return null|string
     */
    public function handle(DeleteChat $command)
    {
        $chat_id = $command->chat_id;
        $actor = $command->actor;

        $chat = $this->chats->findOrFail($chat_id, $actor);

        $users = $chat->users()->get();

        $actor->assertPermission(
            ($actor->isAdmin() || $chat->creator_id == $actor->id) && (count($users) > 2 || $chat->type == 1)
        );

        $this->events->dispatch(
            new Deleting($chat, $actor)
        );

        $chat->users()->detach();
        $chat->delete();

        return $chat;
    }
}
