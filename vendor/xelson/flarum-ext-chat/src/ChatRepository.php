<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat;

use Flarum\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ChatRepository
{
    /**
     * Get a new query builder for the chats table;
     *
     * @return Builder
     */
    public function query()
    {
        return Chat::query();
	}
	
    /**
     * Query for visible chats
     *
     * @param  User 	$actor
     * @return Builder
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function queryVisible(User $actor)
    {
        $query = $this->query();
        $query->where(function ($query) use ($actor) {
            $query->where('type', 1)
            ->orWhereIn('id', ChatUser::select('chat_id')->where('user_id', $actor->id)->get()->toArray());
        });

        return $query;
    }

    /**
     * Find a chat by ID (visible for actor)
     *
     * @param  int 		$id
     * @param  User 	$actor
     * @return Message
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail($id, $actor)
    {
        return $this->queryVisible($actor)->findOrFail($id);
    }
}