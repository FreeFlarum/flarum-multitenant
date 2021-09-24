<?php

/**
 * @package Flarum UiKit
 * @author Sami 'SychO' Mazouz (https://sycho9.github.io)
 * @license MIT
 */

namespace SychO\UiKit\Extend;

use Flarum\Extend\ExtenderInterface;
use Flarum\Frontend\Assets;
use Flarum\Frontend\Compiler\Source\SourceCollector;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

class Register implements ExtenderInterface
{
    /**
     * @var bool
     */
    public static $registered = false;

    public function extend(Container $container, Extension $extension = null)
    {
        if (static::$registered) {
            return;
        }

        foreach (['forum', 'admin'] as $frontend) {
            $container->resolving("flarum.assets.$frontend", function (Assets $assets) use ($frontend) {
                $assets->js(function (SourceCollector $sources) use ($frontend) {
                    $sources->addString(function () {
                        return 'var module={}';
                    });
                    $sources->addFile(__DIR__."/../../js/dist/$frontend.js");
                    $sources->addString(function () {
                        return "flarum.extensions['sycho-uikit']=module.exports";
                    });
                });

                $assets->css(function (SourceCollector $sources) use ($frontend) {
                    $sources->addFile(__DIR__."/../../less/$frontend.less");
                });
            });
        }

        static::$registered = true;
    }
}
