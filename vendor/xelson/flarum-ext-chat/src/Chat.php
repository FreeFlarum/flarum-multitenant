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

class Chat extends AbstractModel
{
    protected $table = 'neonchat_chats';

    protected $dates = ['created_at'];

    /**
     * Create a new message.
     *
     * @param string    $message
     * @param int       $color
     * @param string    $icon
     * @param int    	$type
     * @param int       $creator_id
	 * @param Carbon    $created_at
     * 
     */
    public static function build($title, $color, $icon, $type, $creator_id = null, $created_at = null)
    {
        $chat = new static;

        $chat->title = $title;
        $chat->color = $color;
        $chat->icon = $icon;
        $chat->type = $type;
        $chat->creator_id = $creator_id;
        $chat->created_at = $created_at;

        return $chat;
    }

    public function unreadedCount($chatUser)
    {
        $start = $chatUser->readed_at;
        if($start == null) $start = 0;

        $query = $this->messages()->where('created_at', '>', $start);
        if($chatUser->removed_at) 
            $query->where('created_at', '<=', $chatUser->removed_at);

        return $query->count();
    }

    public function getChatUser(User $user)
    {
        $chatUser = ChatUser::where('chat_id', $this->id)->where('user_id', $user->id)->first();
        if(!$chatUser && $user->id && $this->type == 1)
        {
            $now = Carbon::now();
            $this->users()->attach($user->id, ['readed_at' => $now]);
            $chatUser = ChatUser::build($this->id, $user->id, $now, $now);
        }
        return $chatUser;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'neonchat_chat_user')->withPivot('joined_at', 'removed_by', 'role', 'readed_at', 'removed_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function last_message()
    {
        return $this->hasOne(Message::class)->orderBy('id', 'desc')->whereNull('deleted_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function first_message()
    {
        return $this->hasOne(Message::class)->orderBy('id', 'asc')->whereNull('deleted_by');
    }
}
