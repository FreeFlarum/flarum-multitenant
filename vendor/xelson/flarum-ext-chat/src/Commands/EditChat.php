<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat\Commands;

use Flarum\User\User;

class EditChat
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
	 * @param array $data
	 * @param string $ip_address
	 */
	public function __construct($id, User $actor, $data, string $ip_address)
	{
		$this->chat_id = $id;
		$this->actor = $actor;
		$this->data = $data;
		$this->ip_address = $ip_address;
	}
}