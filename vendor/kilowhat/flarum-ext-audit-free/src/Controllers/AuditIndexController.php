<?php

namespace Kilowhat\Audit\Controllers;

use Flarum\Api\Controller\AbstractListController;
use Flarum\Extension\ExtensionManager;
use Flarum\Http\UrlGenerator;
use Flarum\Query\QueryCriteria;
use Illuminate\Support\Arr;
use Kilowhat\Audit\AuditSerializer;
use Kilowhat\Audit\Search\AuditSearcher;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class AuditIndexController extends AbstractListController
{
    public $serializer = AuditSerializer::class;

    public $include = [
        'actor',
        'discussion',
        'post.discussion',
        'post.user',
        'user',
    ];

    public $sortFields = [
        'createdAt',
    ];

    public $sort = [
        'createdAt' => 'desc',
    ];

    public $limit = 24;

    protected $searcher;
    protected $url;
    protected $extensions;

    public function __construct(AuditSearcher $searcher, UrlGenerator $url, ExtensionManager $extensions)
    {
        $this->searcher = $searcher;
        $this->url = $url;
        $this->extensions = $extensions;
    }

    protected function data(ServerRequestInterface $request, Document $document)
    {
        $actor = $request->getAttribute('actor');

        $actor->assertAdmin();

        if ($this->extensions->isEnabled('flarum-tags')) {
            $this->include[] = 'tag';
        }

        $filters = $this->extractFilter($request) + [
                'q' => '', // Provide default value for q, otherwise we would need a filterer in addition to searcher
            ];
        $sort = $this->extractSort($request);

        $criteria = new QueryCriteria($actor, $filters, $sort);

        $limit = $this->extractLimit($request);
        $offset = $this->extractOffset($request);
        $load = Arr::only($this->extractInclude($request), 'actor'); // We can't preload the other relationships as they are not Eloquent relationships

        $results = $this->searcher->search($criteria, $limit, $offset);

        $this->loadRelations($results->getResults(), $load);

        $document->addPaginationLinks(
            $this->url->to('api')->route('kilowhat-audit.index'),
            $request->getQueryParams(),
            $offset,
            $limit,
            $results->areMoreResults() ? null : 0
        );

        return $results->getResults();
    }
}
