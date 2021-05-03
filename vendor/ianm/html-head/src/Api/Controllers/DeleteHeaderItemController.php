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

use Flarum\Api\Controller\AbstractDeleteController;
use IanM\HtmlHead\Command\DeleteHeaderItem;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;

class DeleteHeaderItemController extends AbstractDeleteController
{
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
    protected function delete(ServerRequestInterface $request)
    {
        /** @var \Flarum\User\User */
        $actor = $request->getAttribute('actor');

        $this->bus->dispatch(
            new DeleteHeaderItem($actor, Arr::get($request->getQueryParams(), 'id'))
        );
    }
}