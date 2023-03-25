<?php

namespace ClarkWinkelmann\CatchTheFish\Controllers;

use ClarkWinkelmann\CatchTheFish\Repositories\FishRepository;
use ClarkWinkelmann\CatchTheFish\Repositories\PlacementRepository;
use ClarkWinkelmann\CatchTheFish\Serializers\FishSerializer;
use Flarum\Api\Controller\AbstractShowController;
use Flarum\Http\RequestUtil;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class FishCatchController extends AbstractShowController
{
    public $serializer = FishSerializer::class;

    public $include = [
        'round.ranking',
    ];

    protected $fishes;
    protected $placement;

    public function __construct(FishRepository $fishes, PlacementRepository $placement)
    {
        $this->fishes = $fishes;
        $this->placement = $placement;
    }

    protected function data(ServerRequestInterface $request, Document $document)
    {
        $id = Arr::get($request->getQueryParams(), 'id');

        $fish = $this->fishes->findOrFail($id);

        return $this->placement->catch(RequestUtil::getActor($request), $fish, $request->getParsedBody());
    }
}
