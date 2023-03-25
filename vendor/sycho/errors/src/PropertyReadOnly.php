<?php
/**
 * @package axy\errors
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

declare(strict_types=1);

namespace axy\errors;

use Exception;

/**
 * This property is read-only
 *
 * @link https://github.com/axypro/errors/blob/master/doc/classes/PropertyReadOnly.md documentation
 */
class PropertyReadOnly extends Logic implements ReadOnlyException
{
    /**
     * {@inheritdoc}
     */
    protected $defaultMessage = 'Property {{ container }}::${{ key }} is read-only';

    /**
     * The constructor
     *
     * @param object|string $container [optional]
     * @param string $key [optional]
     * @param Exception $previous [optional]
     * @param mixed $thrower [optional]
     */
    public function __construct($container = null, ?string $key = null, Exception $previous = null, $thrower = null)
    {
        $this->container = $container;
        $this->key = $key;
        $message = [
            'container' => $container,
            'key' => $key,
        ];
        parent::__construct($message, 0, $previous, $thrower);
    }

    /**
     * @return object|string
     */
    final public function getContainer()
    {
        return $this->container;
    }

    /**
     * @return string
     */
    final public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @var object|string
     */
    protected $container;

    /**
     * @var string
     */
    protected $key;
}
