# Welcome Widgets

[![MIT license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/the-turk/flarum-welcome-widgets/blob/master/LICENSE) [![Latest Stable Version](https://img.shields.io/packagist/v/the-turk/flarum-welcome-widgets.svg)](https://packagist.org/packages/the-turk/flarum-welcome-widgets) [![Total Downloads](https://img.shields.io/packagist/dt/the-turk/flarum-welcome-widgets.svg)](https://packagist.org/packages/the-turk/flarum-welcome-widgets)

Lets users know what's been changed since their last visit. And it looks damn cool with custom themes. And it is fully responsive.

![Welcome Widgets](https://i.ibb.co/Vj12cG3/stats.png)

## Installation

```bash
composer require the-turk/flarum-welcome-widgets
php flarum migrate
```

## Updating

```bash
composer update the-turk/flarum-welcome-widgets
php flarum migrate
php flarum cache:clear
```

## Usage

Just enable the extension.

**Known issues:**
- Widgets won't show up when you login via an external identity provider (like GitHub, Twitter, Facebook etc.) due to a bug in [flarum/core](https://github.com/flarum/core/issues/1994).

## Links

- [Flarum Discuss post](https://discuss.flarum.org/d/24496-welcome-widgets)
- [Source code on GitHub](https://github.com/the-turk/flarum-welcome-widgets)
- [Changelog](https://github.com/the-turk/flarum-welcome-widgets/blob/master/CHANGELOG.md)
- [Report an issue](https://github.com/the-turk/flarum-welcome-widgets/issues)
- [Download via Packagist](https://packagist.org/packages/the-turk/flarum-welcome-widgets)
