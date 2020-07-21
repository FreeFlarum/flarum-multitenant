<?php

namespace FoF\Console\Cache;

use Illuminate\Contracts\Cache\Factory as Contract;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Container\Container;

class Factory implements Contract
{
    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Get a cache store instance by name.
     *
     * @param  string|null $name
     * @return Repository
     */
    public function store($name = null)
    {
        return $this->container['cache.store'];
    }
}
