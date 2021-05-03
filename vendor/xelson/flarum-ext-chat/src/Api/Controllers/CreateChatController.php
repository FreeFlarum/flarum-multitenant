<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat\Api\Controllers;

use Flarum\Api\Controller\AbstractCreateController;
use Illuminate\Contracts\Bus\Dispatcher;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;
use Illuminate\Support\Arr;

use Xelson\Chat\Api\Serializers\ChatSerializer;
use Xelson\Chat\Commands\CreateChat;

class CreateChatController extends AbstractCreateController 
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
        $actor = $request->getAttribute('actor');
        $data = Arr::get($request->getParsedBody(), 'data', []);
        $ip_address = Arr::get($request->getServerParams(), 'REMOTE_ADDR', '127.0.0.1');

        return $this->bus->dispatch(
            new CreateChat($actor, $data, $ip_address)
        );
	}
}