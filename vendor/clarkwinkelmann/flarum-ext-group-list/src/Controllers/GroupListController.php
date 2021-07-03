<?php

namespace ClarkWinkelmann\GroupList\Controllers;

use ClarkWinkelmann\GroupList\GroupListItem;
use ClarkWinkelmann\GroupList\Serializers\GroupListItemSerializer;
use Flarum\Api\Controller\AbstractListController;
use Flarum\Http\RequestUtil;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class GroupListController extends AbstractListController
{
    public $serializer = GroupListItemSerializer::class;

    public $include = [
        'group',
        'members.groups',
    ];

    protected function data(ServerRequestInterface $request, Document $document)
    {
        RequestUtil::getActor($request)->assertCan('clarkwinkelmann-group-list.see');

        $items = GroupListItem::query()->orderBy('order')->get();

        $items->load([
            'group',
            'members',
        ]);

        return $items;
    }
}
