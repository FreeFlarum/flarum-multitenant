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

use Flarum\Api\Controller\AbstractShowController;
use IanM\HtmlHead\Api\Serializers\HeaderSerializer;
use IanM\HtmlHead\Command\UpdateHeaderItem;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class UpdateHeaderItemController extends AbstractShowController
{
    /**
     * {@inheritdoc}
     */
    public $serializer = HeaderSerializer::class;

    /**
     * @var Dispatcher
     */
    protected $bus;

    /**
     * @param Dispatcher $bus
     */
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
        $id = Arr::get($request->getQueryParams(), 'id');
        $data = $request->getParsedBody();

        return $this->bus->dispatch(
            new UpdateHeaderItem($actor, $id, $data)
        );
    }
}
