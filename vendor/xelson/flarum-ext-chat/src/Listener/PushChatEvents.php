<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Xelson\Chat\Listener;

use Illuminate\Contracts\Events\Dispatcher;
use Laminas\Diactoros\ServerRequestFactory;
use Tobscure\JsonApi\Document;
use Tobscure\JsonApi\Resource;
use Xelson\Chat\Api\Serializers\ChatSerializer;
use Xelson\Chat\Api\Serializers\ChatUserSerializer;
use Xelson\Chat\Api\Serializers\MessageSerializer;
use Xelson\Chat\ChatSocket;
use Xelson\Chat\Event\Chat\Saved as ChatSaved;
use Xelson\Chat\Event\Chat\Deleting as ChatDeleting;
use Xelson\Chat\Event\Message\Saved as MessageSaved;
use Xelson\Chat\Event\Message\Deleting as MessageDeleting;

class PushChatEvents
{
    /**
     * @var ChatSocket
     */
    protected $socket;

    public function __construct(ChatSocket $socket)
    {
        $this->socket = $socket;
    }

    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ChatSaved::class, [$this, 'whenChatSaved']);
        $events->listen(ChatDeleting::class, [$this, 'whenChatDeleting']);
        $events->listen(MessageSaved::class, [$this, 'whenMessageSaved']);
        $events->listen(MessageDeleting::class, [$this, 'whenMessageDeleting']);
    }

    protected function buildResponse($data, $actor, $serializerClass, $include = [])
    {
        $document = resolve(Document::class);


        $request = ServerRequestFactory::fromGlobals();

        $request = $request->withAttribute('actor', $actor);

        $serializer = resolve($serializerClass);
        $serializer->setRequest($request);

        $element = (new Resource($data, $serializer))
            ->with($include);

        return $document->setData($element)->jsonSerialize();
    }

    public function whenChatSaved(ChatSaved $event)
    {
        $chat = $event->chat;

        $response = $this->buildResponse($chat, $event->actor, ($event->created ? ChatSerializer::class : ChatUserSerializer::class), ['creator', 'users', 'last_message']);

        $sendData = [
            'chat' => $response
        ];

        if ($event->created) {
            $type = 'chat.create';
        } else {
            $type = 'chat.edit';
            $sendData['eventmsg_range'] = $chat->eventmsg_range;
            $sendData['roles_updated_for'] = $chat->roles_updated_for;
        }

        $this->socket->sendChatEvent($chat->id, $type, $sendData);
    }

    public function whenChatDeleting(ChatDeleting $event)
    {
        $chat = $event->chat;

        $response = $this->buildResponse($chat, $event->actor, ChatSerializer::class, ['creator', 'users', 'last_message']);

        $this->socket->sendChatEvent($chat->id, 'chat.delete', [
            'chat' => $response
        ]);
    }

    public function whenMessageSaved(MessageSaved $event)
    {
        $message = $event->message;

        $response = $this->buildResponse($message, $event->actor, MessageSerializer::class, ['user', 'deleted_by', 'chat']);

        if ($event->created) {
            $type = 'message.post';
        } else {
            $type = 'message.edit';
        }

        $this->socket->sendChatEvent($message->chat_id, $type, [
            'message' => $response
        ]);
    }

    public function whenMessageDeleting(MessageDeleting $event)
    {
        $message = $event->message;

        $response = $this->buildResponse($message, $event->actor, MessageSerializer::class, ['user', 'deleted_by', 'chat']);

        $this->socket->sendChatEvent($message->chat_id, 'message.delete', [
            'message' => $response
        ]);
    }
}
