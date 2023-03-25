<?php
/**
 * @package axy\errors
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

declare(strict_types=1);

namespace axy\errors;

use Exception;

/**
 * An adapter is not defined for this service
 *
 * @link https://github.com/axypro/errors/blob/master/doc/classes/AdapterNotDefined.md documentation
 */
class AdapterNotDefined extends Logic implements NotFound
{
    /**
     * {@inheritdoc}
     */
    protected $defaultMessage = 'Adapter "{{ adapter }}" is not defined for "{{ service }}"';

    /**
     * The constructor
     *
     * @param string $adapter [optional]
     * @param object|string $service [optional]
     * @param Exception $previous [optional]
     * @param mixed $thrower [optional]
     */
    public function __construct(?string $adapter = null, $service = null, Exception $previous = null, $thrower = null)
    {
        $this->adapter = $adapter;
        $this->service = $service;
        $message = [
            'adapter' => $adapter,
            'service' => $service,
        ];
        parent::__construct($message, 0, $previous, $thrower);
    }

    /**
     * @return string
     */
    final public function getAdapter(): string
    {
        return $this->adapter;
    }

    /**
     * @return object|string
     */
    final public function getService()
    {
        return $this->service;
    }

    /**
     * @var string
     */
    protected $adapter;

    /**
     * @var object|string
     */
    protected $service;
}
