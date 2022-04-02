<?php
/**
 *
 *  This file is part of kyrne/whisper
 *
 *  Copyright (c) 2020 Kyrne.
 *
 *  For the full copyright and license information, please view the license.md
 *  file that was distributed with this source code.
 *
 */

namespace Kyrne\Whisper\Commands;


use Flarum\User\Exception\PermissionDeniedException;
use Flarum\User\User;
use http\Message\Parser;
use Kyrne\Whisper\Conversation;
use Kyrne\Whisper\ConversationUser;
use Kyrne\Whisper\Message;
use Pusher\Pusher;

class NewMessageHandler
{
    public function handle(NewMessage $command)
    {
        $actor = $command->actor;
        $data = $command->data;
        $conversationId = $command->conversationId;

        if ($conversationId) {
            $conversation = Conversation::find($conversationId);
        } else {
            $conversation = Conversation::find($data['attributes']['conversationId']);
        }

        if (!$conversation->recipients()->where('user_id', $actor->id)->get()) {
            throw new PermissionDeniedException;
        }

        $message = Message::newMessage($data['attributes']['messageContents'], $actor->id,
            $conversation->id);

        $conversation->increment('total_messages');

        $message->number = $conversation->total_messages;

        $message->save();

        foreach (ConversationUser::where('conversation_id', $conversation->id)->pluck('user_id')->all() as $userId) {
            User::find($userId)->increment('unread_messages');
            $this->pushNewMessage($userId, $message, $conversation->id);
        }

        return $message;
    }

    public function pushNewMessage($userId, $message, $conversationId)
    {
        if (app()->bound(Pusher::class)) {
            app(Pusher::class)->trigger('private-user' . $userId, 'newMessage', [
                'id' => $message->id,
                'message' => json_decode($message->message),
                'createdAt' => (new \DateTime($message->created_at))->format(\DateTime::RFC3339),
                'conversationId' => $conversationId
            ]);
        }
    }
}
