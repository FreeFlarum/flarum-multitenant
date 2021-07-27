<?php

namespace Therealsujitk\GIFs\Controllers;

use Flarum\Api\Controller\AbstractDeleteController;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Therealsujitk\GIFs\GIF;

class RemoveGIFController extends AbstractDeleteController {
    public $serializer = GifSerializer::class;

    protected function delete(ServerRequestInterface $request) {
        $actor = $request->getAttribute('actor');
        $userId = $actor->id;

        $gifID = Arr::get($request->getQueryParams(), 'id');

        return Gif::where('user_id', $userId)
            ->where('gif_id', $gifID)
            ->delete();
    }
}
