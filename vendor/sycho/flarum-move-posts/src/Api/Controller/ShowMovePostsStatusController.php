<?php

namespace SychO\MovePosts\Api\Controller;

use Flarum\Api\Controller\AbstractShowController;
use Flarum\Http\RequestUtil;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;
use SychO\MovePosts\Api\Serializer\MovePostsStatusSerializer;
use SychO\MovePosts\Command\MovePosts;

class ShowMovePostsStatusController extends AbstractShowController
{
    /**
     * @var string
     */
    public $serializer = MovePostsStatusSerializer::class;

    /**
     * @var Dispatcher
     */
    protected $bus;

    public function __construct(Dispatcher $bus)
    {
        $this->bus = $bus;
    }

    protected function data(ServerRequestInterface $request, Document $document)
    {
        $actor = RequestUtil::getActor($request);
        $data = Arr::get($request->getParsedBody(), 'data', []);

        $status = $this->bus->dispatch(
            new MovePosts($actor, $data, true)
        );

        return ['status' => $status];
    }
}
