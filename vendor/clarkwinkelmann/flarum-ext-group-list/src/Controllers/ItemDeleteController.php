<?php

namespace ClarkWinkelmann\GroupList\Controllers;

use ClarkWinkelmann\GroupList\GroupListItem;
use Flarum\Api\Controller\AbstractDeleteController;
use Flarum\Http\RequestUtil;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;

class ItemDeleteController extends AbstractDeleteController
{
    protected function delete(ServerRequestInterface $request)
    {
        RequestUtil::getActor($request)->assertAdmin();

        $id = Arr::get($request->getQueryParams(), 'id');

        $item = GroupListItem::query()->findOrFail($id);

        $item->delete();
    }
}
