<?php
/**
 * Tracing in PHP
 *
 * @package axy\backtrace
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 * @license https://raw.github.com/axypro/backtrace/master/LICENSE MIT
 * @link https://github.com/axypro/backtrace repository
 * @link https://github.com/axypro/backtrace/blob/master/README.md documentation
 * @link https://packagist.org/packages/axy/backtrace composer
 * @uses PHP7.1+
 */

declare(strict_types=1);

namespace axy\backtrace;

use LogicException;

if (!is_file(__DIR__.'/vendor/autoload.php')) {
    throw new LogicException('Please: composer install');
}

require_once(__DIR__.'/vendor/autoload.php');
