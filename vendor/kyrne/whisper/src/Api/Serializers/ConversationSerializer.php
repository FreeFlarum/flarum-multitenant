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

namespace Kyrne\Whisper\Api\Serializers;

use Flarum\Api\Serializer\AbstractSerializer;
use Kyrne\Whisper\Conversation;

class ConversationSerializer extends AbstractSerializer
{
    /**
     * @var string
     */
    protected $type = 'conversations';

    /**
     * @param array|object $conversation
     * @return array
     */
    protected function getDefaultAttributes($conversation)
    {
        if (!($conversation instanceof Conversation)) {
            throw new \InvalidArgumentException(
                get_class($this) . ' can only serialize instances of ' . Conversation::class
            );
        }

        return [
            'status' => json_decode($conversation->status),
            'createdAt' => $this->formatDate($conversation->created_at),
            'updatedAt' => $this->formatDate($conversation->created_at),
            'totalMessages' => $conversation->total_messages,
            'notNew' => (bool) $conversation->notNew,
            'unReadCount' => $conversation->messages()
                ->get()
                ->filter(function ($message) {
                    if (!$message->is_seen) {
                        return $message;
                    }
                })
                ->count()
        ];
    }

    protected function messages($conversation)
    {
        return $this->hasMany($conversation, MessageSerializer::class);
    }

    protected function recipients($conversation)
    {
        return $this->hasMany($conversation, ConversationRecipientSerializer::class);
    }
}