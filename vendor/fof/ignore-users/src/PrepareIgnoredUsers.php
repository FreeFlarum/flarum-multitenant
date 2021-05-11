<?php

/*
 * This file is part of fof/ignore-users.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\IgnoreUsers;

use Flarum\Api\Controller\ListUsersController;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class PrepareIgnoredUsers
{
    public function __invoke(ListUsersController $controller, $data, ServerRequestInterface $request, Document $document)
    {
        /**
         * @var \Flarum\User\User
         */
        $actor = $request->getAttribute('actor');
        $actor->load('ignoredUsers');
    }
}
