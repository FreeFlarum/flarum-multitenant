<?php

namespace ClarkWinkelmann\CatchTheFish;

use Flarum\Database\AbstractModel;
use Illuminate\Database\Eloquent\Builder;

class ConfigureFishesRelationship
{
    protected $foreignKey;

    public function __construct(string $foreignKey)
    {
        $this->foreignKey = $foreignKey;
    }

    public function __invoke(AbstractModel $model)
    {
        return $model->hasMany(Fish::class, $this->foreignKey)
            ->whereHas('round', function (Builder $query) {
                $query->activeRound();
            })
            ->activeFish();
    }
}
