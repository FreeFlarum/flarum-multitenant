<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat\Api\Serializers;

use Flarum\User\User;
use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\Api\Serializer\UserSerializer;

class ChatSerializer extends AbstractSerializer
{
    /**
     * @var string
     */
    protected $type = 'chats';

    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @var User
     */
    protected $actor;

    /**
     * @param PusherWrapper                 $pusher
     */
    public function __construct(
        SettingsRepositoryInterface $settings
    ) 
    {
        $this->settings = $settings;
    }

    /**
     * Get the default set of serialized attributes for a model.
     *
     * @param object|array $model
     * @return array
     */
    protected function getDefaultAttributes($chat)
    {
        $attributes = $chat->getAttributes();
        if($chat->created_at) $attributes['created_at'] = $this->formatDate($chat->created_at);

        return $attributes;
    }

    /**
     * @return \Tobscure\JsonApi\Relationship
     */
    protected function creator($chat)
    {
        return $this->hasOne($chat, UserSerializer::class);
    }

    /**
     * @return \Tobscure\JsonApi\Relationship
     */
    protected function users($chat)
    {
        return $this->hasMany($chat, UserChatSerializer::class);
    }

    /**
     * @return \Tobscure\JsonApi\Relationship
     */
    protected function messages($chat)
    {
        return $this->hasMany($chat, MessageSerializer::class);
    }

    /**
     * @return \Tobscure\JsonApi\Relationship
     */
    protected function last_message($chat)
    {
        return $this->hasOne($chat, MessageSerializer::class);
    }

    /**
     * @return \Tobscure\JsonApi\Relationship
     */
    protected function first_message($chat)
    {
        return $this->hasOne($chat, MessageSerializer::class);
    }
}