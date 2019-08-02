# middlewares/base-path-router

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-travis]][link-travis]
[![Quality Score][ico-scrutinizer]][link-scrutinizer]
[![Total Downloads][ico-downloads]][link-downloads]

A middleware dispatching to other middleware stacks, based on different path prefixes.

## Requirements

* PHP >= 7.0
* A [PSR-7 http library](https://github.com/middlewares/awesome-psr15-middlewares#psr-7-implementations)
* A [PSR-15 middleware dispatcher](https://github.com/middlewares/awesome-psr15-middlewares#dispatcher)

## Installation

This package is installable and autoloadable via Composer as [middlewares/base-path-router](https://packagist.org/packages/middlewares/base-path-router).

```sh
composer require middlewares/base-path-router
```

You may also want to install [middlewares/request-handler](https://packagist.org/packages/middlewares/request-handler).

## Usage

This example uses [middleware/request-handler](https://github.com/middlewares/request-handler) to execute the route handler:

```php
$dispatcher = new Dispatcher([
    new Middlewares\BasePathRouter([
        '/admin' => $admin,
        '/admin/login' => $adminLogin,
        '/blog' => $blog,
    ]),
    new Middlewares\RequestHandler()
]);

$response = $dispatcher->dispatch(new ServerRequest());
```

**BasePathRouter** allows anything to be defined as the router handler (a closure, callback, action object, controller class, etc). The middleware will store this handler in a request attribute.

## Options

#### `__construct(array $middlewares)`

Array with the paths (as keys) and handlers (as values).

#### `defaultHandler(mixed $handler)`

By default, non-matching requests (i.e. those that do not have an URI path start with one of the provided prefixes) will result in an empty 404 response.

This behavior can be changed with the `defaultHandler` method, to assign a default handler to all remaining requests.

```php
$dispatcher = new Dispatcher([
    (new Middlewares\BasePathRouter([
        '/admin' => $admin,
        '/admin/login' => $adminLogin,
        '/blog' => $blog,
    ]))->defaultHandler($everythingElse),

    new Middlewares\RequestHandler()
]);
```

#### `stripPrefix(bool $stripPrefix)`

By default, subsequent middleware will receive a slightly manipulated request object: any matching path prefixes will be stripped from the URI.
This helps when you have a hierarchical setup of routers, where subsequent routers (e.g. one for the API stack mounted under the `/api` endpoint) can ignore the common prefix.

If you want to disable this behavior, use the `stripPrefix` method:

```php
$router = (new Middlewares\BasePathRouter([
              '/prefix1' => $middleware1,
          ]))->stripPrefix(false);
```

#### `attribute(string $attribute)`

The attribute name used to store the handler in the server request. The default attribute name is `request-handler`.

---

Please see [CHANGELOG](CHANGELOG.md) for more information about recent changes and [CONTRIBUTING](CONTRIBUTING.md) for contributing details.

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/middlewares/base-path-router.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/middlewares/base-path-router/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/g/middlewares/base-path-router.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/middlewares/base-path-router.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/middlewares/base-path-router
[link-travis]: https://travis-ci.org/middlewares/base-path-router
[link-scrutinizer]: https://scrutinizer-ci.com/g/middlewares/base-path-router
[link-downloads]: https://packagist.org/packages/middlewares/base-path-router
