<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat\Api\Controllers;

use Xelson\Chat\Api\Serializers\ChatUserSerializer;
use Flarum\Api\Controller\AbstractShowController;
use Illuminate\Contracts\Bus\Dispatcher;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;
use Illuminate\Support\Arr;

use Xelson\Chat\Commands\EditChat;
use Xelson\Chat\Commands\ReadChat;

class EditChatController extends AbstractShowController
{
    /**
     * The serializer instance for this request.
     *
     * @var ChatUserSerializer
     */
    public $serializer = ChatUserSerializer::class;

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
        $data = Arr::get($request->getParsedBody(), 'data', []);
        $ip_address = Arr::get($request->getServerParams(), 'REMOTE_ADDR', '127.0.0.1');

        $readed_at = Arr::get($data, 'attributes.actions.reading');
        if ($readed_at) {
            return $this->bus->dispatch(
                new ReadChat($id, $actor, $readed_at)
            );
        }

        return $this->bus->dispatch(
            new EditChat($id, $actor, $data, $ip_address)
        );
    }
}
