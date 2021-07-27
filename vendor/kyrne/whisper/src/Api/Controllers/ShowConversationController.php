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

namespace Kyrne\Whisper\Api\Controllers;

use Flarum\Api\Controller\AbstractShowController;
use Flarum\User\Exception\PermissionDeniedException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Kyrne\Whisper\Api\Serializers\ConversationSerializer;
use Kyrne\Whisper\Conversation;
use Kyrne\Whisper\Message;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ShowConversationController extends AbstractShowController
{

    /**
     * {@inheritdoc}
     */
    public $serializer = ConversationSerializer::class;

    /**
     * {@inheritdoc}
     */
    public $include = [
        'messages',
        'recipients',
        'recipients.user'
    ];

    /**
     * {@inheritdoc}
     */
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $conversationId = Arr::get($request->getQueryParams(), 'id');
        $actor = $request->getAttribute('actor');

        $include = $this->extractInclude($request);

        $conversation = Conversation::findOrFail($conversationId);

        if (!$conversation->recipients()->where('user_id', $actor->id)->get()) {
            throw new PermissionDeniedException;
        }

        if (in_array('messages', $include)) {
            $messagesRelationship = $this->getMessageRelationships($include);

            $this->includeMessages($conversation, $request, $messagesRelationship);
        }

        $conversation->load(array_filter($include, function ($relationship) {
            return ! Str::startsWith($relationship, 'messages');
        }));

        return $conversation;
    }

    /**
     * @param Conversation $conversation
     * @param ServerRequestInterface $request
     * @param array $include
     * @throws \Tobscure\JsonApi\Exception\InvalidParameterException
     */
    private function includeMessages(Conversation $conversation, ServerRequestInterface $request, array $include)
    {
        $limit = $this->extractLimit($request);
        $offset = $this->getMessageOffset($request, $conversation, $limit);

        $allMessages = $this->loadMessageIds($conversation);
        $loadedMessages = $this->loadPosts($conversation, $offset, $limit, $include);

        array_splice($allMessages, $offset, $limit, $loadedMessages);

        $conversation->setRelation('messages', $allMessages);
    }

    /**
     * @param Conversation $conversation
     * @return mixed
     */
    private function loadMessageIds(Conversation $conversation)
    {
        return $conversation->messages()->latest()->pluck('id')->all();
    }

    /**
     * @param array $include
     * @return array
     */
    private function getMessageRelationships(array $include)
    {
        $prefixLength = strlen($prefix = 'posts.');
        $relationships = [];

        foreach ($include as $relationship) {
            if (substr($relationship, 0, $prefixLength) === $prefix) {
                $relationships[] = substr($relationship, $prefixLength);
            }
        }

        return $relationships;
    }

    /**
     * @param ServerRequestInterface $request
     * @param Conversation $conversation
     * @param $limit
     * @return int|mixed
     * @throws \Tobscure\JsonApi\Exception\InvalidParameterException
     */
    private function getMessageOffset(ServerRequestInterface $request, Conversation $conversation, $limit)
    {
        $queryParams = $request->getQueryParams();
        $actor = $request->getAttribute('actor');

        if (($near = Arr::get($queryParams, 'page.near')) > 1) {
            $offset = message::getIndexForNumber($conversation->id, $near, $actor);
            $offset = max(0, $offset - $limit / 2);
        } else {
            $offset = $this->extractOffset($request);
        }

        return $offset;
    }

    /**
     * @param $conversation
     * @param $offset
     * @param $limit
     * @param array $include
     * @return mixed
     */
    private function loadPosts($conversation, $offset, $limit, array $include)
    {
        $query = $conversation->messages();

        $query->latest()->skip($offset)->take($limit)->with($include);

        $messages = $query->get()->all();

        foreach ($messages as $message) {
            $message->conversation = $conversation;
        }

        return $messages;
    }
}