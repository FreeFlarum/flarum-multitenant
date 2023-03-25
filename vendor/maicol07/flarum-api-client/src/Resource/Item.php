<?php

namespace Maicol07\Flarum\Api\Resource;

use ArrayAccess;
use Illuminate\Support\Arr;
use Maicol07\Flarum\Api\Traits\HasRelationships;
use Maicol07\Flarum\Api\Traits\UsesCache;

class Item extends Resource
{
    use HasRelationships, UsesCache;
    
    /**
     * @var string
     */
    public $type;
    
    /**
     * @var int
     */
    public $id;
    
    /**
     * @var array
     */
    public $attributes = [];
    
    public function __construct(array $item = [])
    {
        $this->id = (int) Arr::get($item, 'id');
        $this->type = Arr::get($item, 'type');
        $this->attributes = Arr::get($item, 'attributes', []);
        
        $this->relations(Arr::get($item, 'relationships', []));
    }
    
    /**
     * @param $name
     * @return array|ArrayAccess|mixed
     */
    public function __get($name)
    {
        if (Arr::has($this->attributes, $name)) {
            return Arr::get($this->attributes, $name);
        }
    
        if (Arr::has($this->relationships, $name)) {
            return Arr::get($this->relationships, $name);
        }
        return $this->$name;
    }
    
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'attributes' => $this->attributes,
            'relationships' => $this->relationships
        ];
    }
}
