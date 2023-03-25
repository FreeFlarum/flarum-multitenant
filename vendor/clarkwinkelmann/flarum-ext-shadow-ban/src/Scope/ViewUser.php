<?php

namespace ClarkWinkelmann\ShadowBan\Scope;

use Carbon\Carbon;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;
use Illuminate\Database\Eloquent\Builder;

class ViewUser
{
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(User $actor, Builder $query)
    {
        if (!$this->settings->get('clarkwinkelmann-shadow-ban.hideUsers') || $actor->can('shadowBan', User::class)) {
            return;
        }

        $query->where(function (Builder $query) use ($actor) {
            $query->whereNull('shadow_banned_until')
                ->orWhere('shadow_banned_until', '<', Carbon::now());

            if (!$actor->isGuest()) {
                $query->orWhere('users.id', '=', $actor->id);
            }
        });
    }
}
