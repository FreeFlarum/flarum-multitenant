<?php

namespace FoF\PrettyMail\Extend;

use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

class PrettyMail implements ExtenderInterface
{
    protected $data = [];
    
    /**
     * @param string $key
     * @param callable|string $callback
     * 
     * The callback can be a closure or an invokable class, and should accept:
     * - \Flarum\Notification\Blueprint\BlueprintInterface $blueprint
     *
     * The callable should return a string value to assign to the key when the template is rendered.
     * - string $value
     * 
     * @return self
     */
    public function addTemplateData(string $key, $callback): self
    {
        $this->data[$key] = $callback;
        
        return $this;
    }
    
    public function extend(Container $container, Extension $extension = null)
    {
        $container->extend('fof-pretty-mail.additional-data', function($items) {
            return array_merge($items, $this->data);
        });
    }
}
