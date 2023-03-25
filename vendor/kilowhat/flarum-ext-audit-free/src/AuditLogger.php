<?php

namespace Kilowhat\Audit;

use Carbon\Carbon;
use Flarum\User\User;

class AuditLogger
{
    /**
     * @var User
     */
    public static $actor = null;

    /**
     * @var string
     */
    public static $client = null;

    /**
     * @var string
     */
    public static $ipAddress = null;

    /**
     * Not stored, but used to know which request was used to trigger an event
     * @var string
     */
    public static $path = null;

    /**
     * Used internally to disable the logger after the database table has been intentionally destroyed
     * @var bool
     */
    public static $disabled = false;

    protected static function getClient(): string
    {
        if (self::$client) {
            return self::$client;
        }

        if (php_sapi_name() == 'cli') {
            return 'cli';
        }

        return 'unknown';
    }

    public static function log(string $action, array $payload = [])
    {
        if (self::$disabled) {
            return;
        }

        $actorId = self::$actor ? self::$actor->id : null;

        $log = new AuditLog();
        $log->actor_id = $actorId ?: null; // $actor->id might return 0 for guests which we turn into null
        $log->client = self::getClient();
        $log->ip_address = self::$ipAddress;
        $log->action = $action;
        $log->payload = count($payload) === 0 ? null : $payload;
        $log->created_at = Carbon::now();
        $log->save();
    }
}
