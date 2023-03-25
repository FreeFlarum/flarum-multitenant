<?php

namespace ClarkWinkelmann\GroupList\Controllers;

use ClarkWinkelmann\GroupList\GroupListItem;
use ClarkWinkelmann\GroupList\Serializers\GroupListItemSerializer;
use Flarum\Api\Controller\AbstractCreateController;
use Flarum\Group\Group;
use Flarum\Http\RequestUtil;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ItemStoreController extends AbstractCreateController
{
    public $serializer = GroupListItemSerializer::class;

    public $include = [
        'group',
    ];

    protected function data(ServerRequestInterface $request, Document $document)
    {
        RequestUtil::getActor($request)->assertAdmin();

        $group = Group::query()->findOrFail(Arr::get($request->getParsedBody(), 'data.attributes.groupId'));

        $item = new GroupListItem();
        $item->group()->associate($group);
        $item->order = Arr::get($request->getParsedBody(), 'data.attributes.order');
        $item->save();

        return $item;
    }
}
