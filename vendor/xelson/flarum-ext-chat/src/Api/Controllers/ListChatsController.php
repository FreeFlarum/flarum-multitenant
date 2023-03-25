<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat\Api\Controllers;

use Xelson\Chat\Api\Serializers\ChatUserSerializer;
use Xelson\Chat\Chat;
use Xelson\Chat\ChatRepository;
use Illuminate\Support\Arr;
use Tobscure\JsonApi\Document;
use Illuminate\Contracts\Bus\Dispatcher;
use Psr\Http\Message\ServerRequestInterface;
use Flarum\Api\Controller\AbstractListController;

class ListChatsController extends AbstractListController
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
    public $include = [
        'creator', 
        'users', 
        'last_message', 
        'last_message.user',
        'first_message'
    ];

    /**
     * @var Dispatcher
     */
    protected $bus;

    /**
     * @param Dispatcher            $bus
	 * @param ChatRepository        $chats
     */
    public function __construct(Dispatcher $bus, ChatRepository $chats)
    {
		$this->bus = $bus;
		$this->chats = $chats;
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
        $include = $this->extractInclude($request);

		return $this->chats->queryVisible($actor)->get()->load($include);
    }
}