<?php

namespace Therealsujitk\GIFs\Controllers;

use Flarum\Api\Controller\AbstractListController;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;
use Therealsujitk\GIFs\GIF;
use Therealsujitk\GIFs\Serializers\GIFSerializer;

class ListGIFController extends AbstractListController {
    public $serializer = GIFSerializer::class;

    protected function data(ServerRequestInterface $request, Document $document) {
        $actor = $request->getAttribute('actor');
        $userId = $actor->id;

        return GIF::where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->get();
    }
}
