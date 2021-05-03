<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat\Commands;

use Flarum\User\User;

class DeleteChat
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
     */
    public function __construct($chat_id, User $actor)
    {
		$this->chat_id = $chat_id;
        $this->actor = $actor;
    }
}