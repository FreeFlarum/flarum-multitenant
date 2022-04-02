<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat;

class EventMessageChatCreated extends AbstractEventMessage
{
	public $id = 'chatCreated';

	/**
	 * @param array $users
	 */
	public function __construct($users)
	{
		$this->users = $users;
	}

	public function getAttributes()
	{
		return [
			'users' => $this->users
		];
	}
}