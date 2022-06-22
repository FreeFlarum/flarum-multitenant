<?php
/**
 * @package axy\errors
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

declare(strict_types=1);

namespace axy\errors;

use Exception;

/**
 * A configuration has an invalid format
 *
 * @link https://github.com/axypro/errors/blob/master/doc/classes/InvalidConfig.md documentation
 */
class InvalidConfig extends Logic
{
    /**
     * {@inheritdoc}
     */
    protected $defaultMessage = '{{ configName }} has an invalid format: "{{ errorMessage }}"';

    /**
     * The constructor
     *
     * @param string $configName [optional]
     *        the config name
     * @param string $errorMessage [optional]
     *        the error message
     * @param int $code [optional]
     *        the error code
     * @param \Exception $p [optional]
     * @param mixed $thrower [optional]
     */
    public function __construct(
        ?string $configName = null,
        ?string $errorMessage = null,
        int $code = 0,
        Exception $p = null,
        $thrower = null
    ) {
        $this->configName = $configName;
        $this->errorMessage = $errorMessage;
        $message = [
            'configName' => $configName,
            'errorMessage' => $errorMessage,
        ];
        parent::__construct($message, $code, $p, $thrower);
    }

    /**
     * @return string
     */
    final public function getConfigName(): ?string
    {
        return $this->configName;
    }

    /**
     * @return string
     */
    final public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }
    /**
     * @var string
     */
    protected $configName;

    /**
     * @var int
     */
    protected $errorMessage;
}
