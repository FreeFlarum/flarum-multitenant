<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat\Commands;

use Flarum\User\User;

class ReadChat
{
	/**
	 * @var int
	 */
	public $id;

	/**
	 * The user performing the action.
	 *
	 * @var User
	 */
	public $actor;

	/**
	 * @param int 	$chat_id
	 * @param User 	$actor
	 * @param array $readed_at
	 */
	public function __construct($id, User $actor, $readed_at)
	{
		$this->chat_id = $id;
		$this->actor = $actor;
		$this->readed_at = $readed_at;
	}
}