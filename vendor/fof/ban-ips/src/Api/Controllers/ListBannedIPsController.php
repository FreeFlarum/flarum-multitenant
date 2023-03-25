<?php

/*
 * This file is part of fof/ban-ips.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\BanIPs\Api\Controllers;

use Flarum\Api\Controller\AbstractListController;
use Flarum\Http\RequestUtil;
use Flarum\Http\UrlGenerator;
use Flarum\Query\QueryCriteria;
use Flarum\User\User;
use FoF\BanIPs\Api\Serializers\BannedIPSerializer;
use FoF\BanIPs\Search\BannedIPFilterer;
use FoF\BanIPs\Search\BannedIPSearcher;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ListBannedIPsController extends AbstractListController
{
    /**
     * {@inheritdoc}
     */
    public $serializer = BannedIPSerializer::class;

    /**
     * {@inheritdoc}
     */
    public $include = ['user', 'creator'];

    /**
     * @var BannedIPSearcher
     */
    protected $searcher;

    /**
     * @var BannedIPFilterer
     */
    protected $filterer;

    /**
     * @var UrlGenerator
     */
    protected $url;

    /**
     * @param BannedIPSearcher $searcher
     * @param BannedIPFilterer $filterer
     * @param UrlGenerator     $url
     */
    public function __construct(BannedIPSearcher $searcher, BannedIPFilterer $filterer, UrlGenerator $url)
    {
        $this->searcher = $searcher;
        $this->filterer = $filterer;
        $this->url = $url;
    }

    /**
     * {@inheritdoc}
     */
    protected function data(ServerRequestInterface $request, Document $document)
    {
        /**
         * @var User
         */
        $actor = RequestUtil::getActor($request);

        $actor->assertCan('fof.banips.viewBannedIPList');

        $filters = $this->extractFilter($request);
        $sort = $this->extractSort($request);

        $limit = $this->extractLimit($request);
        $offset = $this->extractOffset($request);
        $include = $this->extractInclude($request);

        $criteria = new QueryCriteria($actor, $filters, $sort);
        if (array_key_exists('q', $filters)) {
            $results = $this->searcher->search($criteria, $limit, $offset);
        } else {
            $results = $this->filterer->filter($criteria, $limit, $offset);
        }

        $document->addPaginationLinks(
            $this->url->to('api')->route('fof.ban-ips.index'),
            $request->getQueryParams(),
            $offset,
            $limit,
            $results->areMoreResults() ? null : 0
        );

        return $results->getResults()->load($include);
    }
}
