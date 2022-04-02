<?php

namespace Nearata\TwoFactor;

use Flarum\User\User;

class Helpers
{
    public static function isBackupCode(User $user, string $code): bool
    {
        $backups = json_decode($user->twofa_codes);

        if (count($backups) === 0) {
            return false;
        }

        $firstCode = array_shift($backups);

        if ($code !== $firstCode) {
            return false;
        }

        $user->twofa_codes = json_encode($backups);
        $user->save();

        return true;
    }
}
