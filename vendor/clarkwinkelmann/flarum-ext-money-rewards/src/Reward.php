<?php

namespace ClarkWinkelmann\MoneyRewards;

use Carbon\Carbon;
use Flarum\Database\AbstractModel;
use Flarum\Post\Post;
use Flarum\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $post_id
 * @property int $giver_user_id
 * @property int $receiver_user_id
 * @property float $amount
 * @property bool $new_money
 * @property string $comment
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Reward extends AbstractModel
{
    protected $table = 'money_rewards';

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function giver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'giver_user_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_user_id');
    }
}
