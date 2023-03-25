<?php

namespace Maicol07\Flarum\Api\Traits;

use Maicol07\Flarum\Api\Client;
use Maicol07\Flarum\Api\Resource\Item;

trait UsesCache
{
    /**
     * @return Item|UsesCache
     */
    public function cache()
    {
        /** @noinspection PhpParamsInspection */
        Client::getCache()->set($this->id, $this, $this->type);

        return $this;
    }
}
