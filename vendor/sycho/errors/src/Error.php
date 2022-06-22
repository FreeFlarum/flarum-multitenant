<?php
/**
 * @package axy\errors
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

declare(strict_types=1);

namespace axy\errors;

use axy\backtrace\ExceptionTrace;

/**
 * The basic error in the axy hierarchy
 *
 * @link https://github.com/axypro/errors/blob/master/doc/errors.md documentation
 */
interface Error
{
    /**
     * Returns the filename of the original exception point
     *
     * @return string
     */
    public function getOriginalFile(): string;

    /**
     * Returns the line number of the original exception point
     *
     * @return int
     */
    public function getOriginalLine(): int;

    /**
     * Returns the truncated trace instance
     *
     * @return ExceptionTrace
     */
    public function getTruncatedTrace(): ExceptionTrace;
}
