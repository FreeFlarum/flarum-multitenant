# axy\backtrace

Backtrace helper library (PHP).

[![Latest Stable Version](https://img.shields.io/packagist/v/axy/backtrace.svg?style=flat-square)](https://packagist.org/packages/axy/backtrace)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.1-8892BF.svg?style=flat-square)](https://php.net/)
[![Build Status](https://img.shields.io/travis/axypro/backtrace/master.svg?style=flat-square)](https://travis-ci.org/axypro/backtrace)
[![Coverage Status](https://coveralls.io/repos/axypro/backtrace/badge.svg?branch=master&service=github)](https://coveralls.io/github/axypro/backtrace?branch=master)
[![License](https://poser.pugx.org/axy/backtrace/license)](LICENSE)

* The library does not require any dependencies.
* Install: `composer require axy/backtrace`.
* Tested for PHP 7.1, 7.2, 7.3
* License: [MIT](LICENSE).

### Legacy (PHP5.4+, branch php5)

[![Latest Stable Version](https://img.shields.io/packagist/v/axy/backtrace.svg?style=flat-square)](https://packagist.org/packages/axy/backtrace)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.4-8892BF.svg?style=flat-square)](https://php.net/)
[![Build Status](https://img.shields.io/travis/axypro/backtrace/php5.svg?style=flat-square)](https://travis-ci.org/axypro/backtrace)

* Install: `composer require axy/backtrace=^1`

### Documentation

It contains some tools to simplify the work with the call stack.

The library is intended primarily for debug.
For example, it used in [axypro/errors](https://github.com/axypro/errors) for cut uninformative part of the stack
(when displaying an exception).

#### The library classes

 * [Trace](doc/Trace.md): the call stack.
 * [ExceptionTrace](doc/ExceptionTrace.md): the point of an exception.
