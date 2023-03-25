<?php

namespace Maicol07\Flarum\Api\Traits;

use Illuminate\Support\Arr;
use Maicol07\Flarum\Api\Client;
use Maicol07\Flarum\Api\Resource\Item;

trait HasRelationships
{
    
    
    /**
     * @var array
     */
    public $relationships = [];

    /**
     * @param array $relations
     */
    protected function relations(array $relations = []): void
    {
        foreach ($relations as $attribute => $relation) {
            $data = Arr::get($relation, 'data');
        
            // Single item.
            if (Arr::get($data, 'type')) {
                $this->relationships[$attribute] = $this->parseRelationshipItem(
                    Arr::get($data, 'type'),
                    Arr::get($data, 'id')
                );
            } else {
                $this->relationships[$attribute] = [];

                foreach ($data as $item) {
                    $id = (int) Arr::get($item, 'id');
                    $this->relationships[$attribute][$id] = $this->parseRelationshipItem(
                        Arr::get($item, 'type'),
                        $id
                    );
                }
            }
        }
    }

    /**
     * @param string $type
     * @param int $id
     * @return Item|null
     */
    protected function parseRelationshipItem(string $type, int $id): ?Item
    {
        return Client::getCache()->get($id, null, $type);
    }
}
