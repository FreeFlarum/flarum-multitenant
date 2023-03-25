<?php

namespace Ziven\transferMoney\Controller;

use Ziven\transferMoney\Serializer\TransferMoneySerializer;
use Ziven\transferMoney\Model\TransferMoney;
use Flarum\Api\Controller\AbstractListController;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;
use Flarum\Http\UrlGenerator;

class ListTransferMoneyHistoryController extends AbstractListController{
    public $serializer = TransferMoneySerializer::class;
    public $include = ['fromUser','targetUser',];
    protected $url;

    public function __construct(UrlGenerator $url){
        $this->url = $url;
    }

    protected function data(ServerRequestInterface $request, Document $document){
        $params = $request->getQueryParams();
        $actor = $request->getAttribute('actor');
        $limit = $this->extractLimit($request);
        $offset = $this->extractOffset($request);

        $userID = $actor->id;
        $transferMoneyQuery = TransferMoney::where(["from_user_id"=>$userID])->orWhere(["target_user_id"=>$userID]);
        $transferMoneyResult = $transferMoneyQuery
            ->skip($offset)
            ->take($limit + 1)
            ->orderBy('id', 'desc')
            ->get();

        $hasMoreResults = $limit > 0 && $transferMoneyResult->count() > $limit;

        if($hasMoreResults){
            $transferMoneyResult->pop();
        }

        $document->addPaginationLinks(
            $this->url->to('api')->route('money.history'),
            $params,
            $offset,
            $limit,
            $hasMoreResults ? null : 0
        );

        return $transferMoneyResult;
    }
}
