<?php

namespace ClarkWinkelmann\CatchTheFish;

use Carbon\Carbon;
use Flarum\Database\AbstractModel;
use Flarum\Discussion\Discussion;
use Flarum\Http\UrlGenerator;
use Flarum\Post\Post;
use Flarum\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $round_id
 * @property int $discussion_id_placement
 * @property int $post_id_placement
 * @property int $user_id_placement
 * @property int $user_id_last_catch
 * @property int $user_id_last_placement
 * @property int $user_id_last_naming
 * @property Carbon $placement_valid_since
 * @property Carbon $last_caught_at
 * @property string $name
 * @property string $image
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Round $round
 * @property Discussion $placementDiscussion
 * @property Post $placementPost
 * @property User $placementUser
 * @property User $lastUserCatch
 * @property User $lastUserPlacement
 * @property User $lastUserNaming
 * @property string $image_url
 */
class Fish extends AbstractModel
{
    protected $table = 'catchthefish_fishes';

    protected $casts = [
        'placement_valid_since' => 'datetime',
        'last_caught_at' => 'datetime',
    ];

    protected $fillable = [
        'name',
    ];

    public $timestamps = true;

    public function round(): BelongsTo
    {
        return $this->belongsTo(Round::class);
    }

    public function placementDiscussion(): BelongsTo
    {
        return $this->belongsTo(Discussion::class, 'discussion_id_placement');
    }

    public function placementPost(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id_placement');
    }

    public function placementUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_placement');
    }

    public function lastUserCatch(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_last_catch');
    }

    public function lastUserPlacement(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_last_placement');
    }

    public function lastUserNaming(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_last_naming');
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        if (strpos($this->image, '://') === false) {
            /**
             * @var $generator UrlGenerator
             */
            $generator = resolve(UrlGenerator::class);

            return $generator->to('forum')->path('assets/catch-the-fish/' . $this->image);
        }

        return $this->image;
    }

    public function scopeActiveFish(Builder $query): Builder
    {
        return $query->where('placement_valid_since', '<', Carbon::now());
    }
}
