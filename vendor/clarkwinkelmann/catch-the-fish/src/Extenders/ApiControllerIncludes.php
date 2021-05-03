<?php

namespace ClarkWinkelmann\CatchTheFish\Extenders;

use Flarum\Extend\ApiController;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

/**
 * Custom extender that allows calling ApiController::addIncludes on multiple controller classes at once
 */
class ApiControllerIncludes implements ExtenderInterface
{
    protected $controllerClasses = [];
    protected $addIncludes = [];

    public function __construct(array $controllerClasses)
    {
        $this->controllerClasses = $controllerClasses;
    }

    public function addInclude($name): self
    {
        $this->addIncludes[] = $name;

        return $this;
    }

    public function extend(Container $container, Extension $extension = null)
    {
        foreach ($this->controllerClasses as $controllerClass) {
            $extender = new ApiController($controllerClass);

            foreach ($this->addIncludes as $addInclude) {
                $extender->addInclude($addInclude);
            }

            $extender->extend($container, $extension);
        }
    }
}
