<?php

namespace Therealsujitk\GIFs\Controllers;

use Flarum\Api\Controller\AbstractCreateController;
use Flarum\User\User;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Therealsujitk\GIFs\GIF;
use Therealsujitk\GIFs\Serializers\GIFSerializer;
use Tobscure\JsonApi\Document;

class AddGIFController extends AbstractCreateController {
    public $serializer = GIFSerializer::class;

    protected function data(ServerRequestInterface $request, Document $document) {
        $actor = $request->getAttribute('actor');
        $attributes = Arr::get($request->getParsedBody(), 'data.attributes', []);

        $gif = new GIF();
        $gif->user()->associate($actor);
        $gif->gif_id = Arr::get($attributes, 'gifID', null);    // This will cause an error if gifId is not present

        $gif->save();

        return $gif;
    }
}
