<?php

namespace ClarkWinkelmann\DiscussionBookmarks\Content;

use Flarum\Api\Client;
use Flarum\Frontend\Document;
use Flarum\Locale\Translator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;

class Bookmarks
{
    protected $api;
    protected $view;
    protected $translator;

    public function __construct(Client $api, Factory $view, Translator $translator)
    {
        $this->api = $api;
        $this->view = $view;
        $this->translator = $translator;
    }

    public function __invoke(Document $document, ServerRequestInterface $request)
    {
        $queryParams = $request->getQueryParams();

        $sort = Arr::pull($queryParams, 'sort');
        $q = Arr::pull($queryParams, 'q', '');
        $page = Arr::pull($queryParams, 'page', 1);

        $sortMap = resolve('flarum.forum.discussions.sortmap');

        $params = [
            'sort' => $sort && isset($sortMap[$sort]) ? $sortMap[$sort] : '',
            'filter' => [
                'q' => "$q is:bookmarked",
            ],
            'page' => ['offset' => ($page - 1) * 20, 'limit' => 20],
        ];

        $apiDocument = $this->getApiDocument($request, $params);

        $document->title = $this->translator->trans('clarkwinkelmann-discussion-bookmarks.forum.page.title');
        $document->content = $this->view->make('flarum.forum::frontend.content.index', compact('apiDocument', 'page'));
        $document->payload['apiDocument'] = $apiDocument;
    }

    private function getApiDocument(ServerRequestInterface $request, array $params)
    {
        return json_decode($this->api->withParentRequest($request)->withQueryParams($params)->get('/discussions')->getBody());
    }
}
