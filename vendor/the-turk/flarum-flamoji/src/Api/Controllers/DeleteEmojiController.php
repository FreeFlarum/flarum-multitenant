<?php

namespace TheTurk\Flamoji\Api\Controllers;

use Flarum\Api\Controller\AbstractDeleteController;
use TheTurk\Flamoji\Commands\DeleteEmoji;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;

class DeleteEmojiController extends AbstractDeleteController
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
        $this->bus->dispatch(
            new DeleteEmoji(Arr::get($request->getQueryParams(), 'id'))
        );
    }
}
