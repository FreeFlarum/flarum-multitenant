<?php

namespace Nearata\MinecraftAvatars;

use Illuminate\Http\Client\Factory;

class Helpers
{
    public static function isUsername(string $minotar): bool
    {
        $validUsernameRegex = '/^[a-zA-Z0-9_]{1,16}$/';
        return preg_match($validUsernameRegex, $minotar);
    }

    public static function getUUID(string $username): string
    {
        $response = (new Factory())->get('https://api.mojang.com/users/profiles/minecraft/' . $username);

        if ($response->status() === 204) {
            return '';
        }

        return $response->json('id');
    }
}
