<?php


namespace FoF\Transliterator;


use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

class Extend implements ExtenderInterface
{
    private $transliterators = [];

    public function add(string $name, callable $callable) {
        $this->transliterators[$name] = $callable;

        return $this;
    }

    public function extend(Container $container, Extension $extension = null)
    {
        foreach ($this->transliterators as $name => $callable) {
            Transliterator::$transliterators[$name] = $callable;
        }
    }
}
