<?php

/*
 * This file is part of ianm/html-head.
 *
 * Copyright (c) 2021 IanM.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace IanM\HtmlHead\Api\Controllers;

use Flarum\Api\Controller\AbstractListController;
use Flarum\Http\RequestUtil;
use IanM\HtmlHead\Api\Serializers\HeaderSerializer;
use IanM\HtmlHead\Header;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ListHeadersController extends AbstractListController
{
    /**
     * {@inheritdoc}
     */
    public $serializer = HeaderSerializer::class;

    /**
     * {@inheritdoc}
     */
    protected function data(ServerRequestInterface $request, Document $document)
    {
        RequestUtil::getActor($request)->assertAdmin();

        return Header::all();
    }
}
