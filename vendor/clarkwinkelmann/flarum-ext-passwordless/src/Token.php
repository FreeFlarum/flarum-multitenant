<?php

namespace ClarkWinkelmann\PasswordLess;

use Carbon\Carbon;
use Flarum\Database\AbstractModel;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property Carbon $created_at
 * @property Carbon $expires_at
 * @property bool $remember
 */
class Token extends AbstractModel
{
    protected $table = 'clarkwinkelmann_passwordless_tokens';

    protected $dates = [
        'created_at',
        'expires_at',
    ];

    public static function generate($userId, bool $remember = false, int $lifetime = 5)
    {
        $token = new static;

        $token->token = Str::random(20);
        $token->user_id = $userId;
        $token->remember = $remember;
        $token->created_at = Carbon::now();
        $token->expires_at = Carbon::now()->addMinutes($lifetime);

        return $token;
    }

    public static function deleteOldTokens(int $lifetime = 5)
    {
        static::query()->where('expires_at', '<', Carbon::now()->subMinutes($lifetime)->subDay())->delete();
    }

    public function isExpired(): bool
    {
        return $this->expires_at->lt(Carbon::now());
    }
}
