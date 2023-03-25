<?php

namespace ClarkWinkelmann\MoneyRewards\Controllers;

use ClarkWinkelmann\MoneyRewards\Reward;
use ClarkWinkelmann\MoneyRewards\RewardSerializer;
use Flarum\Api\Controller\AbstractListController;
use Flarum\Http\RequestUtil;
use Flarum\User\UserRepository;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ListUserRewardController extends AbstractListController
{
    public $serializer = RewardSerializer::class;

    public $include = [
        'post.discussion',
        'giver',
        'receiver',
    ];

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function data(ServerRequestInterface $request, Document $document)
    {
        $actor = RequestUtil::getActor($request);

        $user = $this->repository->findOrFail(Arr::get($request->getQueryParams(), 'id'), $actor);

        $actor->assertCan('seeMoneyRewardHistory', $user);

        return Reward::query()
            ->where('giver_user_id', $user->id)
            ->orWhere('receiver_user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
