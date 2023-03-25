<?php
/**
 * @package axy\errors
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

declare(strict_types=1);

namespace axy\errors;

use Exception;

/**
 * A dependency is not installed
 *
 * @link https://github.com/axypro/errors/blob/master/doc/classes/NotInstalled.md documentation
 */
class NotInstalled extends Logic implements DependencyError
{
    /**
     * {@inheritdoc}
     */
    protected $defaultMessage = 'Required dependency "{{ dependency }}" for {{ action }}';

    /**
     * The constructor
     *
     * @param string $dependency [optional]
     * @param string $action [optional]
     * @param Exception $previous [optional]
     * @param mixed $thrower [optional]
     */
    public function __construct(
        string $dependency = null,
        string $action = null,
        Exception $previous = null,
        $thrower = null
    ) {
        $this->dependency = $dependency;
        $this->action = $action;
        $message = [
            'dependency' => $dependency,
            'action' => ($action !== null) ? $action : 'something',
        ];
        parent::__construct($message, 0, $previous, $thrower);
    }

    /**
     * @return string
     */
    final public function getDependency(): ?string
    {
        return $this->dependency;
    }

    /**
     * @return string
     */
    final public function getAction(): ?string
    {
        return $this->action;
    }

    /**
     * @var string
     */
    private $dependency;

    /**
     * @var string
     */
    private $action;
}
