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
use Xelson\Chat\MessageRepository;
use Xelson\Chat\MessageValidator;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Arr;
use Xelson\Chat\Event\Message\Saved;

class EditMessageHandler
{
    /**
     * @var MessageRepository
     */
    protected $messages;

    /**
     * @var MessageValidator
     */
    protected $validator;

    /**
     * @var ChatRepository
     */
    protected $chats;

    /**
     * @param MessageRepository             $messages
     * @param MessageValidator              $validator
     * @param ChatRepository                $chats
     * @param Dispatcher                    $events
     */
    public function __construct(
        MessageRepository $messages,
        MessageValidator $validator,
        ChatRepository $chats,
        Dispatcher $events
    ) {
        $this->messages  = $messages;
        $this->validator = $validator;
        $this->chats = $chats;
        $this->events = $events;
    }

    /**
     * Handles the command execution.
     *
     * @param EditMessage $command
     * @return null|string
     */
    public function handle(EditMessage $command)
    {
        $message_id = $command->id;
        $actor = $command->actor;
        $data = $command->data;
        $attributes = Arr::get($data, 'attributes', []);
        $actions = $attributes['actions'];

        $message = $this->messages->findOrFail($message_id);

        $actor->assertPermission(
            !$message->type
        );

        $chat = $this->chats->findOrFail($message->chat_id, $actor);
        $chatUser = $chat->getChatUser($actor);

        if (isset($actions['msg'])) {
            $actor->assertCan('xelson-chat.permissions.edit');
            $actor->assertPermission($actor->id == $message->user_id);
            $actor->assertPermission($message->message != $actions['msg']);

            $message->message = $actions['msg'];
            $message->edited_at = Carbon::now();

            $this->validator->assertValid($message->getDirty());

            $message->save();
        } else if (isset($actions['hide'])) {
            $actor->assertCan('xelson-chat.permissions.delete');

            if ($actions['hide']) {
                if ($message->user_id != $actor->id) {
                    $actor->assertPermission(
                        $chatUser && $chatUser->role != 0
                    );
                }
                $message->deleted_by = $actor->id;
            } else {
                if ($message->deleted_by != $actor->id) {
                    $actor->assertPermission(
                        $chatUser && $chatUser->role != 0
                    );
                }
                $message->deleted_by = null;
            }

            $message->save();
            $actions['invoker'] = $actor->id;
        }
        $message->actions = $actions;

        $this->events->dispatch(
            new Saved($message, $actor, $data, false)
        );

        return $message;
    }
}
