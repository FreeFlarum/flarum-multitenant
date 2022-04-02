<?php
/**
 *
 *  This file is part of kyrne/whisper
 *
 *  Copyright (c) 2020 Kyrne.
 *
 *  For the full copyright and license information, please view the license.md
 *  file that was distributed with this source code.
 *
 */

namespace Kyrne\Whisper;

use Carbon\Carbon;
use Flarum\Database\AbstractModel;
use Flarum\User\User;

class Conversation extends AbstractModel
{
    protected $table = 'conversations';

    public $timestamps = true;

    public $fillable = [
        'user_one_id',
        'user_two_id',
        'status',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public static function start()
    {
        $conversation = new static;

        $conversation->created_at = Carbon::now();

        return $conversation;
    }

    public static function findOrFail($id)
    {
        $query = static::where('id', $id);

        return $query->firstOrFail();
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id')
            ->with('user');
    }

    public function recipients() {
        return $this->hasMany(ConversationUser::class, 'conversation_id')
            ->with('user');
    }
}
