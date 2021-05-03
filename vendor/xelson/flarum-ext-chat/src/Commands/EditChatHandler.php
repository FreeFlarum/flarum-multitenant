<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat\Commands;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Xelson\Chat\ChatValidator;
use Xelson\Chat\ChatRepository;
use Xelson\Chat\EventMessageChatEdited;
use Xelson\Chat\EventMessageChatAddRemoveUser;
use Xelson\Chat\Commands\PostEventMessage;
use Xelson\Chat\Exceptions\ChatEditException;
use Illuminate\Contracts\Bus\Dispatcher as BusDispatcher;
use Illuminate\Contracts\Events\Dispatcher;
use Xelson\Chat\Event\Chat\Saved;

class EditChatHandler
{
    /**
     * @param ChatValidator $validator
     * @param ChatRepository $chats
     * @param BusDispatcher $bus
     * @param Dispatcher $events
     */
    public function __construct(ChatValidator $validator, ChatRepository $chats, BusDispatcher $bus, Dispatcher $events)
    {
        $this->validator = $validator;
        $this->chats  = $chats;
        $this->bus = $bus;
        $this->events = $events;
    }

    /**
     * Handles the command execution.
     *
     * @param EditChat $command
     * @return null|string
     */
    public function handle(EditChat $command)
    {
        $chat_id = $command->chat_id;
        $actor = $command->actor;
        $data = $command->data;
        $attributes = Arr::get($data, 'attributes', []);
        $ip_address = $command->ip_address;

        $chat = $this->chats->findOrFail($chat_id, $actor);
        $all_users = $chat->users()->get();
        $all_ids = [];
        $current_ids = [];
        $users = [];

        foreach ($all_users as $user) {
            $all_ids[] = $user->id;
            $users[$user->id] = $user;
            if (!$user->pivot->removed_at) $current_ids[] = $user->id;
        }

        $editable_colums = ['title', 'icon', 'color'];

        $events_list = [];
        $attrsChanged = false;

        $actor->assertPermission(
            in_array($actor->id, $all_ids)
        );

        $localUser = $users[$actor->id];

        $actor->assertPermission(
            !$localUser->pivot->removed_at || $localUser->pivot->removed_by == $actor->id
        );

        $now = Carbon::now();
        $isCreator = $actor->id == $chat->creator_id || (!$chat->creator_id && $actor->isAdmin());
        $isPM = count($all_users) <= 2 && $chat->type == 0;
        $isChannel = $chat->type == 1;

        foreach ($editable_colums as $column) {
            if (Arr::get($data, 'attributes.' . $column, 0) && $chat[$column] != $attributes[$column]) {
                $actor->assertPermission(
                    $isChannel || !$isPM
                );

                $actor->assertPermission(
                    $localUser->pivot->role || $isCreator
                );

                $message = $this->bus->dispatch(
                    new PostEventMessage($chat->id, $actor, new EventMessageChatEdited($column, $chat[$column], $attributes[$column]), $ip_address)
                );
                $events_list[] = $message->id;
                $chat[$column] = $attributes[$column];

                $attrsChanged = true;
            }
        }

        $added = Arr::get($data, 'attributes.users.added', 0);
        $removed = Arr::get($data, 'attributes.users.removed', 0);

        if ($added || $removed) {
            // Редактирование списка пользователей:
            // Решить проблему с сокетами. Для публичного сокета сообщения приходят безусловно, а для приватного сокета
            // есть кейс, что если игрок ливнет с чата, то для него не придет сокет, так как он ливнул до отправки сообщения по сокету, а сокет фильтрует сообщения
            // по отношению к ливнутым
            // Удалить текущие permissions для модераторов и перенести их в каждый отдельный чат

            $added_ids = [];
            $removed_ids = [];
            if ($added) foreach ($added as $user) $added_ids[] = $user['id'];
            if ($removed) foreach ($removed as $user) $removed_ids[] = $user['id'];
            $added_ids = array_unique($added_ids);
            $removed_ids = array_unique($removed_ids);

            if (count(array_intersect($added_ids, $removed_ids)))
                throw new ChatEditException('Trying to add and remove users in the same time');

            if (count($added_ids) && count(array_intersect($added_ids, $current_ids)))
                throw new ChatEditException(sprintf('Cannot add new users: one of them already in chat (%s and %s)', json_encode($added_ids), json_encode($current_ids)));

            if (count($removed_ids) && !count(array_intersect($removed_ids, $current_ids)))
                throw new ChatEditException('Cannot kick users: one of them already kicked');

            if ($isPM && (count($added_ids) > 1 || count($removed_ids) > 1 || (count($added_ids) && $added_ids[0] != $actor->id) || (count($removed_ids) && $removed_ids[0] != $actor->id)))
                throw new ChatEditException('Invalid user array for PM chat room');

            if (count($added_ids) || count($removed_ids)) {
                $added_pairs = [];
                $removed_pairs = [];

                foreach ($added_ids as $v)
                    $added_pairs[$v] = ['removed_at' => null, 'removed_by' => null];

                foreach ($removed_ids as $v) {
                    $actor->assertPermission(
                        $v == $actor->id || $users[$v]->pivot->role < $localUser->pivot->role || $isCreator
                    );
                    $removed_pairs[$v] = ['removed_at' => $now, 'removed_by' => $actor->id];
                }

                $chat->users()->syncWithoutDetaching($added_pairs + $removed_pairs);

                if (!$isChannel) {
                    $message = $this->bus->dispatch(
                        new PostEventMessage($chat->id, $actor, new EventMessageChatAddRemoveUser($added_ids, $removed_ids), $ip_address)
                    );
                    $events_list[] = $message->id;
                }
            }
        }

        $roles_updated_for = [];
        $edited = Arr::get($data, 'attributes.users.edited', 0);
        if ($edited) {
            $actor->assertPermission(
                !$isPM && $isCreator
            );

            $syncUsers = [];

            foreach ($edited as $user) {
                $id = $user['id'];
                $role = $user['role'];

                if (array_search($id, $all_ids) === false)
                    continue;

                if ($id == $actor->id)
                    throw new ChatEditException('Сannot set a role for yourself');

                if (!in_array($role, [1, 2]))
                    throw new ChatEditException('Unacceptable role');

                $syncUsers[$id] = ['role' => $role];
                if ($role != $users[$id]->pivot->role) $roles_updated_for[] = $id;
            }

            $chat->users()->syncWithoutDetaching($syncUsers);
        }

        if ($attrsChanged) {
            $this->validator->assertValid($chat->getDirty());
            $chat->save();
        }
        $chat->eventmsg_range = $events_list;
        $chat->roles_updated_for = $roles_updated_for;

        $this->events->dispatch(
            new Saved($chat, $actor, $data, false)
        );

        return $chat;
    }
}
