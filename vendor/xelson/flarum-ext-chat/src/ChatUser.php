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

class ChatUser extends AbstractModel
{
    protected $table = 'neonchat_chat_user';

    protected $dates = ['joined_at', 'readed_at', 'removed_at'];
    
    /**
     * @param int $chat_id
     * @param int $user_id
     * @param Carbon $joined_at
     * @param mixed $removed_by
     * @param int $role
     * @param Carbon $readed_at
     * @param Carbon $removed_at
     * 
     * @return ChatUser
     */
    public static function build(int $chat_id, int $user_id, $joined_at, $readed_at = null, int $role = 0, $removed_by = null, $removed_at = null)
    {
        $model = new static;

        $model->chat_id = $chat_id;
        $model->user_id = $user_id;
        $model->role = $role;
        $model->joined_at = $joined_at;
        $model->removed_by = $removed_by;
        $model->removed_at = $removed_at;
        $model->readed_at = $readed_at;

        return $model;
    }
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chat()
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
