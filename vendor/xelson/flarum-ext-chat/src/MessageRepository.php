<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat;

use Carbon\Carbon;
use Flarum\User\User;
use Flarum\Database\AbstractModel;
use Illuminate\Database\Eloquent\Builder;
use Flarum\Settings\SettingsRepositoryInterface;

class MessageRepository
{
    public $messages_per_fetch = 20;

    /**
     * Get a new query builder for the posts table.
     *
     * @return Builder
     */
    public function query()
    {
        return Message::query();
    }

    /**
     * Find a message by ID
     *
     * @param  int 		$id
     * @param  User 	$actor
     * @return Message
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail($id)
    {
        return $this->query()->findOrFail($id);
    }
    
    /**
     * Query for visible messages
     *
     * @param  Chat     $chat
     * @param  User 	$actor
     * @return Builder
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function queryVisible(Chat $chat, User $actor)
    {
        $settings = resolve(SettingsRepositoryInterface::class);

        $query = $this->query();
        $chatUser = $chat->getChatUser($actor);

        if(!$chatUser || !$chatUser->role)
            $query->where(function ($query) use ($actor) {
                $query->whereNull('deleted_by')
                ->orWhere('deleted_by', $actor->id);
            });

        return $query;
    }

    /**
     * Fetching visible messages by message id
     * 
     * @param  int 		$id
     * @param  User     $actor
     * @param  int      $chat_id
     * @return array
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function fetch($time, User $actor, Chat $chat)
    {
        $chatUser = $chat->getChatUser($actor);

        $top = $this->queryVisible($chat, $actor)->where('chat_id', $chat->id);
        if($chatUser && $chatUser->removed_at)
            $top->where('created_at', '<=', $chatUser->removed_at);
        $top->where('created_at', '>=', new Carbon($time))->limit($this->messages_per_fetch + 1);

        $bottom = $this->queryVisible($chat, $actor)->where('chat_id', $chat->id);
        if($chatUser && $chatUser->removed_at)
            $bottom->where('created_at', '<=', $chatUser->removed_at);
        $bottom->where('created_at', '<', new Carbon($time))->orderBy('id', 'desc')->limit($this->messages_per_fetch);

        $messages = $top->union($bottom);

        return $messages->get();
    }
}