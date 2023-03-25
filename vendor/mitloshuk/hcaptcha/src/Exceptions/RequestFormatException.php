<?php

namespace HCaptcha\Exceptions;

use Exception;

/**
 * Exception for request format, that must implements RequestInterface
 *
 * @package hCaptcha
 */
class RequestFormatException extends Exception
{
    public function __construct($message = 'Request must implements RequestInterface', $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}