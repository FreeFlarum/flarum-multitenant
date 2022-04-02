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
use Flarum\Api\Serializer\BasicUserSerializer;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;
use Pusher\Pusher;

class TypingPusherController extends AbstractShowController
{
    public $serializer = BasicUserSerializer::class;

    public function data(ServerRequestInterface $request, Document $document)
    {
        $data = $request->getParsedBody();

        if (app()->bound(Pusher::class)) {
            app(Pusher::class)->trigger('private-user' . $data['userId'], 'typing', [
                'conversationId' => $data['conversationId']
            ]);
        }

        return true;
    }
}