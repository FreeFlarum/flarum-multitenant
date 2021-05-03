<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat;

class ChatSocket extends PusherWrapper
{
	protected $channel = 'neonchat.events';

	public function sendChatEvent($chat_id, $event_id, $options)
	{
		if (!$this->pusher()) return;

		$chat = Chat::findOrFail($chat_id);

		$attributes = [
			'event' => [
				'id' => $event_id,
				'chat_id' => $chat_id
			],
			'response' => $options
		];
		if($chat) $chat->type ? $this->sendPublic($attributes) : $this->sendPrivate($chat->id, $attributes);
	}

	public function sendPublic($attributes)
	{
		$this->pusher()->trigger('public', $this->channel, $attributes);
	}

	public function sendPrivate($chat_id, $attributes)
	{
		$chatUsers = ChatUser::where('chat_id', $chat_id)->pluck('user_id')->all();
		foreach($chatUsers as $user_id)
			$this->pusher()->trigger('private-user' . $user_id, $this->channel, $attributes);
	}
}