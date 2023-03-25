<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat\Api\Controllers;

use Flarum\Api\Controller\ShowUserController;
use Flarum\Api\Serializer\CurrentUserSerializer;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ShowUserSafeController extends ShowUserController
{
    /**
     * ShowUserController causes an immediate error if the user does not exist by the request, 
     * so checking the user for existence turns into an 404 error, which is then displayed 
     * to the user. Don't beat me if this is a bad solution
     * 
     * {@inheritdoc}
     */
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $id = Arr::get($request->getQueryParams(), 'id');

        if (! is_numeric($id)) {
            $id = $this->users->getIdForUsername($id);
        }

        $actor = $request->getAttribute('actor');

        if ($actor->id == $id) {
            $this->serializer = CurrentUserSerializer::class;
        }

        return $this->users->query()->where('id', $id)->whereVisibleTo($actor)->first();
    }
}
