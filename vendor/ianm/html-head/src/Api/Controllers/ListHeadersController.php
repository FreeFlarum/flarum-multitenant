<?php

/*
 * This file is part of ianm/html-head.
 *
 * Copyright (c) 2021 IanM.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace IanM\HtmlHead\Api\Controllers;

use Flarum\Api\Controller\AbstractListController;
use Flarum\Http\UrlGenerator;
use Flarum\Query\QueryCriteria;
use IanM\HtmlHead\Api\Serializers\HeaderSerializer;
use IanM\HtmlHead\Search\HeadItemSearcher;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ListHeadersController extends AbstractListController
{
    /**
     * {@inheritdoc}
     */
    public $serializer = HeaderSerializer::class;

    /**
     * @var HeadItemSearcher
     */
    protected $searcher;

    /**
     * @var UrlGenerator
     */
    protected $url;

    /**
     * @param HeadItemSearcher $searcher
     * @param UrlGenerator     $url
     */
    public function __construct(HeadItemSearcher $searcher, UrlGenerator $url)
    {
        $this->searcher = $searcher;
        $this->url = $url;
    }

    /**
     * {@inheritdoc}
     */
    protected function data(ServerRequestInterface $request, Document $document)
    {
        /** @var \Flarum\User\User */
        $actor = $request->getAttribute('actor');

        $actor->assertAdmin();

        $query = Arr::get($this->extractFilter($request), 'q');
        $sort = $this->extractSort($request);

        $criteria = new QueryCriteria($actor, $query, $sort);
        $limit = $this->extractLimit($request);
        $offset = $this->extractOffset($request);
        $results = $this->searcher->search($criteria, $limit, $offset);

        $document->addPaginationLinks(
            $this->url->to('api')->route('ianm.html-headers.index'),
            $request->getQueryParams(),
            $offset,
            $limit,
            $results->areMoreResults() ? null : 0
        );

        return $results->getResults();
    }
}
