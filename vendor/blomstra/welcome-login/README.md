# Welcome Login

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/blomstra/mobile-login.svg)](https://packagist.org/packages/blomstra/welcome-login) [![Total Downloads](https://img.shields.io/packagist/dt/blomstra/welcome-login.svg)](https://packagist.org/packages/blomstra/welcome-login)

A [Flarum](http://flarum.org) extension. Add signup and login buttons to the WelcomeHero banner

## Usage

This extension forces the `WelcomeHero` banner to be displayed to guest users (ie not logged in), and places additional `Signup` and `Login` buttons directly in it. A setting is provided to only show this on mobile viewports, or to every screen size.

This extension overrides aspects of the `WelcomeHero`, and therefore may be incompatible with other extensions/themes that also attempt to alter it.

## Installation

Install with composer:

```sh
composer require blomstra/welcome-login:"*"
```

## Updating

```sh
composer update blomstra/welcome-login
php flarum cache:clear
```

## Links

- [Packagist](https://packagist.org/packages/blomstra/welcome-login)
- [GitHub](https://github.com/blomstra/flarum-ext-welcome-login)
- [Discuss](https://discuss.flarum.org/d/PUT_DISCUSS_SLUG_HERE)
