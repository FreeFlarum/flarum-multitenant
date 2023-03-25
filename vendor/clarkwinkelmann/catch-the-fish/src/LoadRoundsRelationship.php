<?php

namespace ClarkWinkelmann\CatchTheFish;

use ClarkWinkelmann\CatchTheFish\Repositories\RoundRepository;
use Flarum\Api\Controller\ShowForumController;
use Flarum\Http\RequestUtil;
use Psr\Http\Message\ServerRequestInterface;

class LoadRoundsRelationship
{
    protected $repository;

    public function __construct(RoundRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ShowForumController $controller, &$data, ServerRequestInterface $request)
    {
        if (RequestUtil::getActor($request)->can('catchthefish.visible')) {
            $data['catchTheFishActiveRounds'] = $this->repository->allActive();
        } else {
            $data['catchTheFishActiveRounds'] = [];
        }
    }
}
