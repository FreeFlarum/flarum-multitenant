<?php

/*
 * This file is part of askvortsov/flarum-moderator-warnings
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Askvortsov\FlarumWarnings\Api\Controller;

use Askvortsov\FlarumWarnings\Api\Serializer\WarningSerializer;
use Askvortsov\FlarumWarnings\Model\Warning;
use Flarum\Api\Controller\AbstractListController;
use Flarum\Http\RequestUtil;
use Flarum\User\Exception\PermissionDeniedException;
use Flarum\User\User;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ListWarningsController extends AbstractListController
{
    public $serializer = WarningSerializer::class;

    public $include = ['warnedUser', 'addedByUser', 'hiddenByUser', 'post', 'post.discussion', 'post.user'];

    /**
     * Get the data to be serialized and assigned to the response document.
     *
     * @param ServerRequestInterface $request
     * @param Document               $document
     *
     * @throws PermissionDeniedException
     *
     * @return mixed
     */
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $id = Arr::get($request->getQueryParams(), 'user_id');

        $actor = RequestUtil::getActor($request);

        $actor->assertCan('user.viewWarnings', User::find($id));

        if ($actor->can('user.manageWarnings')) {
            return Warning::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        } else {
            return Warning::where('user_id', $id)->where('hidden_at', null)->orderBy('created_at', 'desc')->get();
        }
    }
}
