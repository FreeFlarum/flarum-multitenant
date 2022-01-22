<?php

/*
 * This file is part of fof/username-request.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\UserRequest;

use Flarum\Api\Controller\ShowForumController;
use Flarum\Http\RequestUtil;
use Psr\Http\Message\ServerRequestInterface;

class AddUsernameRequests
{
    public function __invoke(ShowForumController $controller, &$data, ServerRequestInterface $request)
    {
        $data['username_requests'] = null;

        if (RequestUtil::getActor($request)->can('user.viewUsernameRequests')) {
            $data['username_requests'] = UsernameRequest::where('status', 'Sent')
            ->oldest()
            ->get();
        }

        return $data;
    }
}
