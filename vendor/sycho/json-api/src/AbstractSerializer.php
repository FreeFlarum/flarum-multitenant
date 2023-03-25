<?php

/*
 * This file is part of JSON-API.
 *
 * (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tobscure\JsonApi;

use LogicException;

abstract class AbstractSerializer implements SerializerInterface
{
    /**
     * The type.
     *
     * @var string
     */
    protected $type;

    /**
     * {@inheritdoc}
     */
    public function getType($model)
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function getId($model)
    {
        return $model->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes($model, array $fields = null)
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getLinks($model)
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getMeta($model)
    {
        return [];
    }

    /**
     * {@inheritdoc}
     *
     * @throws \LogicException
     */
    public function getRelationship($model, $name)
    {
        // commit https://github.com/SychO9/json-api-php/commit/8d4116ec580febf36d7e6995829a6f5adf6f9c48
        // was a breaking change to underscore relatonship names.
        // This one liner keeps the new behavior while still supporting underscore relationships,
        // by checking first if the method exits before converting the name to camel-case.
        $method = method_exists($this, $name) ? $name : $this->getRelationshipMethodName($name);

        if (method_exists($this, $method)) {
            $relationship = $this->$method($model);

            if ($relationship !== null && ! ($relationship instanceof Relationship)) {
                throw new LogicException('Relationship method must return null or an instance of Tobscure\JsonApi\Relationship');
            }

            return $relationship;
        }
    }

    /**
     * Get the serializer method name for the given relationship.
     *
     * snake_case and kebab-case are converted into camelCase.
     *
     * @param string $name
     *
     * @return string
     */
    private function getRelationshipMethodName($name)
    {
        if (stripos($name, '-')) {
            $name = lcfirst(implode('', array_map('ucfirst', explode('-', $name))));
        }

        if (stripos($name, '_')) {
            $name = lcfirst(implode('', array_map('ucfirst', explode('_', $name))));
        }

        return $name;
    }
}
