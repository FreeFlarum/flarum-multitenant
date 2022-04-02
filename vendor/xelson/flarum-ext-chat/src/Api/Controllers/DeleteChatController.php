<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat\Api\Controllers;

use Xelson\Chat\Commands\DeleteChat;
use Flarum\Api\Controller\AbstractShowController;
use Illuminate\Contracts\Bus\Dispatcher;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;
use Illuminate\Support\Arr;

use Xelson\Chat\Api\Serializers\ChatSerializer;
class DeleteChatController extends AbstractShowController
{
    /**
     * The serializer instance for this request.
     *
     * @var ChatSerializer
     */
	public $serializer = ChatSerializer::class;

    /**
     * {@inheritdoc}
     */
    public $include = ['creator', 'users', 'last_message'];

    /**
     * @var Dispatcher
     */
    protected $bus;

    /**
     * @param Dispatcher            $bus
     */
    public function __construct(Dispatcher $bus)
    {
        $this->bus = $bus;
	}

    /**
     * Get the data to be serialized and assigned to the response document.
     *
     * @param ServerRequestInterface $request
     * @param Document               $document
     * @return mixed
     */
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $id = Arr::get($request->getQueryParams(), 'id');
        $actor = $request->getAttribute('actor');

        return $this->bus->dispatch(
            new DeleteChat($id, $actor)
        );
	}
}
