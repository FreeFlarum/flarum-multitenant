<?php

namespace ClarkWinkelmann\CatchTheFish;

use Carbon\Carbon;
use Flarum\Database\AbstractModel;
use Flarum\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property Carbon $starts_at
 * @property Carbon $ends_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Fish[]|Collection $fishes
 * @property Ranking[]|Collection $rankings
 */
class Round extends AbstractModel
{
    protected $table = 'catchthefish_rounds';

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    protected $fillable = [
        'name',
        'starts_at',
        'ends_at',
    ];

    public $timestamps = true;

    public function fishes(): HasMany
    {
        return $this->hasMany(Fish::class);
    }

    public function rankings(): HasMany
    {
        return $this->hasMany(Ranking::class);
    }

    public function userRanking(User $user): ?Ranking
    {
        return $this->rankings()->where('user_id', $user->id)->first();
    }

    public function scopeActiveRound(Builder $query): Builder
    {
        $now = Carbon::now();

        return $query->where('ends_at', '>', $now)
            ->where(function (Builder $query) use ($now) {
                $query->whereNull('starts_at')
                    ->orWhere('starts_at', '<', $now);
            });
    }
}
