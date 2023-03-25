<?php

namespace Nearata\MinecraftAvatars;

use Illuminate\Http\Client\Factory;
use Illuminate\Support\Arr;

class Helpers
{
    public static $usernames = ['MHF_Steve', 'MHF_Alex'];

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

    public static function getRandomUsername(): string
    {
        return Arr::random(Helpers::$usernames);
    }

    public static function isUUID(string $minotar): bool
    {
        $validUUIDPlainRegex = '[0-9a-f]{32}';
        $validUUIDDashRegex = '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}';
        $validUUIDRegex = '/^(' . $validUUIDPlainRegex . '|' . $validUUIDDashRegex . ')$/';

        return preg_match($validUUIDRegex, $minotar);
    }
}
