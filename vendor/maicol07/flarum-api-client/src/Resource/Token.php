<?php


namespace Maicol07\Flarum\Api\Resource;

use ArrayAccess;
use Illuminate\Support\Arr;

class Token
{

    /** @var string|ArrayAccess|mixed */
    public $token;

    /** @var string|ArrayAccess|mixed */
    public $userId;

    /** @var array Array that contains both token and user ID */
    private $array;

    public function __construct(array $json = [])
    {
        $this->array = $json;
        $this->token = Arr::get($json, 'token');
        $this->userId = Arr::get($json, 'userId');
    }

    /**
     * @param string $name
     * @return array|ArrayAccess|mixed
     */
    public function __get(string $name)
    {
        if ($name === 'userId') {
            return $this->userId;
        }

        return $this->token;
    }

    public function toArray(): array
    {
        return $this->array;
    }
}
