<?php
/**
 * @package axy\errors
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */
/* @noinspection PhpMissingParentConstructorInspection */

declare(strict_types=1);

namespace axy\errors;

use Exception;
use axy\errors\helpers\ErrorTrait;

/**
 * The basic logic-error in the axy hierarchy
 *
 * @link https://github.com/axypro/errors/blob/master/doc/errors.md documentation
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
class Logic extends \LogicException implements Error
{
    use ErrorTrait;

    /**
     * The constructor
     *
     * @param mixed $message [optional]
     *        the error message or variables for the message template
     * @param int $code [optional]
     *        the error code
     * @param \Exception $previous [optional]
     *        the previous exception
     * @param mixed $thrower [optional]
     *        one who has thrown exception (an object or a namespace)
     */
    public function __construct($message = null, int $code = 0, Exception $previous = null, $thrower = null)
    {
        $this->callErrorTrait($message, $code, $previous, $thrower);
    }
}
