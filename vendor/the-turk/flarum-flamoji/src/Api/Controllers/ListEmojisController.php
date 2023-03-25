<?php

namespace TheTurk\Flamoji\Api\Controllers;

use Flarum\Api\Controller\AbstractListController;
use Flarum\Http\UrlGenerator;
use TheTurk\Flamoji\Api\Serializers\EmojiSerializer;
use TheTurk\Flamoji\Models\Emoji;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ListEmojisController extends AbstractListController
{
    /**
     * {@inheritdoc}
     */
    public $serializer = EmojiSerializer::class;

    public $sortFields = ['id'];

    /**
     * @var UrlGenerator
     */
    protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Tobscure\JsonApi\Document               $document
     */
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $params = $request->getQueryParams();

        $limit = $this->extractLimit($request);

        // This is a trick to be able to retrieve all
        // emojis from the db. We need them to create a JSON file to export.
        // -- need to think a better way to do this.
        if ($limit == $this->limit) {
            return Emoji::all();
        }

        $offset = $this->extractOffset($request);

        $results = Emoji::skip($offset)->take($limit + 1)->orderBy('id', 'desc')->get();

        // Check for more results
        $hasMoreResults = $limit > 0 && $results->count() > $limit;

        // Pop
        if ($hasMoreResults) {
            $results->pop();
        }

        // Add pagination to the request
        $document->addPaginationLinks(
            $this->url->to('api')->route('emojis.list'),
            $params,
            $offset,
            $limit,
            $hasMoreResults ? null : 0
        );

        return $results;
    }
}
