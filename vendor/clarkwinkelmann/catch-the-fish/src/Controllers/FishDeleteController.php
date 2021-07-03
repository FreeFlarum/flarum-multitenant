<?php

namespace ClarkWinkelmann\CatchTheFish\Controllers;

use ClarkWinkelmann\CatchTheFish\Repositories\FishRepository;
use Flarum\Api\Controller\AbstractDeleteController;
use Flarum\Http\RequestUtil;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;

class FishDeleteController extends AbstractDeleteController
{
    protected $fishes;

    public function __construct(FishRepository $fishes)
    {
        $this->fishes = $fishes;
    }

    protected function delete(ServerRequestInterface $request)
    {
        $id = Arr::get($request->getQueryParams(), 'id');

        $fish = $this->fishes->findOrFail($id);

        RequestUtil::getActor($request)->assertCan('delete', $fish);

        $this->fishes->delete($fish);
    }
}
