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

use Flarum\Api\Controller\AbstractCreateController;
use IanM\HtmlHead\Api\Serializers\HeaderSerializer;
use IanM\HtmlHead\Command\CreateHeaderItem;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class CreateHeaderItemController extends AbstractCreateController
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

        return $this->bus->dispatch(
            new CreateHeaderItem($actor, Arr::get($request->getParsedBody(), 'data', []))
        );
    }
}
