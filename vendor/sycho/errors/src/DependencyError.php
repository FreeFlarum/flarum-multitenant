<?php
/**
 * @package axy\errors
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

declare(strict_types=1);

namespace axy\errors;

/**
 * An error associated with dependency (extension, composer package, plugin)
 *
 * @link https://github.com/axypro/errors/blob/master/doc/errors.md documentation
 */
interface DependencyError extends Error
{
}
