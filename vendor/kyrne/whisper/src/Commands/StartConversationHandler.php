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


use Flarum\User\AssertPermissionTrait;
use Illuminate\Contracts\Bus\Dispatcher as BusDispatcher;
use InvalidArgumentException;
use Kyrne\Whisper\Conversation;
use Kyrne\Whisper\ConversationUser;

class StartConversationHandler
{
    /**
     * @var BusDispatcher
     */
    protected $bus;

    public function __construct(BusDispatcher $bus)
    {
        $this->bus = $bus;
    }

    public function handle(StartConversation $command)
    {
        $actor = $command->actor;
        $data = $command->data;

        $actor->assertCan('startConversation');

        if (intval($data['attributes']['recipient']) === intval($actor->id)) {
            throw new InvalidArgumentException;
        }

        $conversationIds = ConversationUser::where('user_id', $actor->id)
            ->pluck('conversation_id')
            ->all();

        $oldConversation = null;

        foreach ($conversationIds as $id) {
            $conversation = conversation::find($id);

            if (in_array($data['attributes']['recipient'], $conversation
                ->recipients()
                ->pluck('user_id')
                ->all())) {
                $oldConversation = $conversation;
                break;
            }
        }

        if ($oldConversation) {
            $oldConversation->notNew = true;
            return $oldConversation;
        }

        $conversation = Conversation::start();

        // TODO validator

        $conversation->save();

        foreach (array_merge([$actor->id], (array)$data['attributes']['recipient']) as $recipientId) {
            $recipient = new ConversationUser();
            $recipient->conversation_id = $conversation->id;
            $recipient->user_id = $recipientId;

            $recipient->save();
        }

        try {
            $this->bus->dispatch(
                new NewMessage($actor, $data, $conversation->id)
            );
        } catch (\Exception $e) {
            $conversation->delete;

            throw $e;
        }

        return $conversation;
    }
}
