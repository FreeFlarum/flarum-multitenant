<?php

namespace ClarkWinkelmann\CatchTheFish;

use Flarum\Database\AbstractModel;
use Flarum\User\User;

/**
 * @property int $id
 * @property int $round_id
 * @property int $user_id
 * @property int $catch_count
 *
 * @property Round $round
 * @property User $user
 */
class Ranking extends AbstractModel
{
    protected $table = 'catchthefish_rankings';

    protected $casts = [
        'catch_count' => 'int',
    ];

    protected $fillable = [
        'round_id',
        'user_id',
        'catch_count',
    ];

    public $timestamps = true;

    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
