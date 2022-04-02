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

use Kyrne\Whisper\Api\Serializers\ConversationSerializer;
use Flarum\Api\Controller\AbstractCreateController;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Arr;
use Kyrne\Whisper\Commands\StartConversation;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class CreateConversationController extends AbstractCreateController
{
    /**
     * @var string
     */
    public $serializer = ConversationSerializer::class;

    public $include = [
        'messages',
        'recipients',
        'recipients.user'
    ];

    /**
     * @var Dispatcher
     */
    protected $bus;

    public function __construct(Dispatcher $bus)
    {
        $this->bus = $bus;
    }

    /**
     * {@inheritdoc}
     */
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $actor = $request->getAttribute('actor');

        $conversation = $this->bus->dispatch(
            new StartConversation($actor, Arr::get($request->getParsedBody(), 'data', []))
        );

        return $conversation;
    }
}