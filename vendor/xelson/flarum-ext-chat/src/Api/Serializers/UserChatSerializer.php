<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat\Api\Serializers;

use Xelson\Chat\Chat;
use Flarum\Api\Serializer\UserSerializer;

class UserChatSerializer extends UserSerializer
{
    /**
     * @param \Flarum\User\User $user
     * @return array
     */
    protected function getDefaultAttributes($user)
    {
		$attributes = parent::getDefaultAttributes($user);

		$attributes['chat_pivot'] = [];
		$chats = $user->chats()->get();
		
		foreach($chats as $chat)
			$attributes['chat_pivot'][$chat->id] = $chat->pivot;
		
		return $attributes;
	}
}