<?php

/*
 * This file is part of fof/username-request.
 *
 * Copyright (c) 2019 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace FoF\UserRequest\Api\Controller;

use Flarum\Api\Controller\AbstractListController;
use FoF\UserRequest\Api\Serializer\RequestSerializer;
use FoF\UserRequest\UsernameRequest;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ListRequestsController extends AbstractListController
{
    /**
     * {@inheritdoc}
     */
    public $serializer = RequestSerializer::class;

    /**
     * {@inheritdoc}
     */
    public $include = [
        'user',
    ];

    /**
     * {@inheritdoc}
     */
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $actor = $request->getAttribute('actor');

        $actor->assertCan('user.viewUsernameRequests');

        return UsernameRequest::whereVisibleTo($actor)
            ->where('status', 'Sent')
            ->latest('username_requests.created_at')
            ->get();
    }
}
