<?php

namespace ClarkWinkelmann\GroupList\Controllers;

use ClarkWinkelmann\GroupList\GroupListItem;
use ClarkWinkelmann\GroupList\Serializers\GroupListItemSerializer;
use Flarum\Api\Controller\AbstractShowController;
use Flarum\Formatter\Formatter;
use Flarum\Http\RequestUtil;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ItemUpdateController extends AbstractShowController
{
    public $serializer = GroupListItemSerializer::class;

    public $include = [
        'group',
    ];

    protected function data(ServerRequestInterface $request, Document $document)
    {
        RequestUtil::getActor($request)->assertAdmin();

        $id = Arr::get($request->getQueryParams(), 'id');

        $attributes = Arr::get($request->getParsedBody(), 'data.attributes', []);

        /**
         * @var $item GroupListItem
         */
        $item = GroupListItem::query()->findOrFail($id);

        if (Arr::exists($attributes, 'content')) {
            /**
             * @var $formatter Formatter
             */
            $formatter = resolve(Formatter::class);

            $item->content = $formatter->parse(Arr::get($attributes, 'content'));
        }

        if (Arr::exists($attributes, 'order')) {
            $item->order = Arr::get($attributes, 'order');
        }

        $item->save();

        return $item;
    }
}
