<?php


namespace Kyrne\Whisper;

use Flarum\Api\Controller;
use Flarum\Extend;
use Flarum\Formatter\Event\Configuring;
use Flarum\User\User;
use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Api\Serializer\CurrentUserSerializer;
use Kyrne\Whisper\Api\Controllers;
use Kyrne\Whisper\Api\Serializers\ConversationRecipientSerializer;
use Kyrne\Whisper\Api\Serializers\ConversationSerializer;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/extension.less')
        ->route('/whisper/messages/{id}', 'whisper.messages')
        ->route('/whisper/conversations', 'whisper.conversation'),
    new Extend\Locales(__DIR__.'/resources/locale'),
    (new Extend\Model(User::class))
        ->hasMany('conversations' ,ConversationUser::class, 'user_id'),
    (new Extend\Routes('api'))
        ->get('/whisper/conversations', 'whisper.conversations.index', Controllers\ListConversationsController::class)
        ->get('/whisper/messages/{id}', 'whisper.messages.list', Controllers\ListMessagesController::class)
        ->post('/whisper/conversations', 'whisper.conversations.create', Controllers\CreateConversationController::class)
        ->post('/whisper/messages', 'whisper.messages.create', Controllers\CreateMessageController::class)
        ->post('/whisper/messages/typing', 'whisper.message.typing', Controllers\TypingPusherController::class)
        ->post('/whisper/messages/read', 'whisper.message.read', Controllers\ReadMessageController::class)
        ->delete('/whisper/messages{id}', 'whisper.messages.delete', Controllers\DeleteMessageController::class)
        //->patch('/messages/{id}', 'messages.update', Controllers\UpdateMessageController::class)
        //->delete('/messages/{id}', 'messages.delete', Controllers\DeleteMessageController::class)
        ->get('/whisper/conversations/{id}', 'whisper.conversations.show', Controllers\ShowConversationController::class),

    (new Extend\ApiSerializer(ForumSerializer::class))
        ->attribute('canMessage', function (ForumSerializer $serializer) {
            return $serializer->getActor()->can('startConversation');
        }),

    (new Extend\ApiSerializer(CurrentUserSerializer::class))
        ->attribute('unreadMessages', function (CurrentUserSerializer $serializer) {
            return $serializer->getActor()->unread_messages;
        }),

    (new Extend\Settings())
        ->serializeToForum('whisperReturnKey', 'kyrne-whisper.return_key', function ($value) {
            return (bool) $value;
        }),
    (new Extend\ApiSerializer(CurrentUserSerializer::class))
        ->hasMany('conversations', ConversationRecipientSerializer::class),

    (new Extend\ApiController(Controller\ListUsersController::class))
        ->addInclude('conversations'),
    (new Extend\ApiController(Controller\ShowUserController::class))
        ->addInclude('conversations'),
    (new Extend\ApiController(Controller\CreateUserController::class))
        ->addInclude('conversations'),
    (new Extend\ApiController(Controller\UpdateUserController::class))
        ->addInclude('conversations'),
];
