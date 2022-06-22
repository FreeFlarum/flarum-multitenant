<?php

namespace ClarkWinkelmann\CatchTheFish\Access;

use Carbon\Carbon;
use ClarkWinkelmann\CatchTheFish\Fish;
use Flarum\Foundation\ValidationException;
use Flarum\Locale\Translator;
use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class FishPolicy extends AbstractPolicy
{
    const TRANSLATION_PREFIX = 'clarkwinkelmann-catch-the-fish.api.';

    public function create(User $actor)
    {
        return $actor->can('catchthefish.moderate');
    }

    public function update(User $actor, Fish $fish)
    {
        return $this->create($actor);
    }

    public function delete(User $actor, Fish $fish)
    {
        return $this->update($actor, $fish);
    }

    public function see(User $actor, Fish $fish)
    {
        return $actor->can('catchthefish.visible');
    }

    public function catch(User $actor, Fish $fish)
    {
        if ($actor->id === $fish->user_id_last_placement) {
            throw new ValidationException([
                'placement' => resolve(Translator::class)->trans(self::TRANSLATION_PREFIX . 'cannot-catch-own-fish'),
            ]);
        }

        if (!$fish->placement_valid_since || $fish->placement_valid_since->gt(Carbon::now())) {
            throw new ValidationException([
                'placement' => resolve(Translator::class)->trans(self::TRANSLATION_PREFIX . 'cannot-catch-hold-fish'),
            ]);
        }

        return $actor->can('participate', $fish->round);
    }

    protected function updateCatched(User $actor, Fish $fish)
    {
        if (!$fish->user_id_last_catch || $fish->user_id_last_catch !== $actor->id) {
            throw new ValidationException([
                'placement' => resolve(Translator::class)->trans(self::TRANSLATION_PREFIX . 'fish-update-wrong-user'),
            ]);
        }

        if (!$fish->placement_valid_since || $fish->placement_valid_since->lt(Carbon::now())) {
            throw new ValidationException([
                'placement' => resolve(Translator::class)->trans(self::TRANSLATION_PREFIX . 'fish-update-expired'),
            ]);
        }

        return true;
    }

    public function name(User $actor, Fish $fish)
    {
        return $this->updateCatched($actor, $fish) && $actor->can('catchthefish.choose-name');
    }

    public function place(User $actor, Fish $fish)
    {
        return $this->updateCatched($actor, $fish) && $actor->can('catchthefish.choose-place');
    }
}
